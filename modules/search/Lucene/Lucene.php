<?php

/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Search_Lucene
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Lucene.php 24593 2012-01-05 20:35:02Z matthew $
 */
/** User land classes and interfaces turned on by Zend/Search/Lucene.php file inclusion. */
/** @todo Section should be removed with ZF 2.0 release as obsolete                      */
/** Document_Html */

//require_once 'Zend/Search/Lucene/Document/Html.php';
//
///** Document_Docx */
//require_once 'Zend/Search/Lucene/Document/Docx.php';
//
///** Document_Pptx */
//require_once 'Zend/Search/Lucene/Document/Pptx.php';
//
///** Document_Xlsx */
//require_once 'Zend/Search/Lucene/Document/Xlsx.php';
//
///** Zend_Search_Lucene_Search_QueryParser */
//require_once 'Zend/Search/Lucene/Search/QueryParser.php';
//
///** QueryHit */
//require_once 'Zend/Search/Lucene/Search/QueryHit.php';
//
///** Zend_Search_Lucene_Analysis_Analyzer */
//require_once 'Zend/Search/Lucene/Analysis/Analyzer.php';
//
///** Zend_Search_Lucene_Search_Query_Term */
//require_once 'Zend/Search/Lucene/Search/Query/Term.php';
//
///** Zend_Search_Lucene_Search_Query_Phrase */
//require_once 'Zend/Search/Lucene/Search/Query/Phrase.php';
//
///** Zend_Search_Lucene_Search_Query_MultiTerm */
//require_once 'Zend/Search/Lucene/Search/Query/MultiTerm.php';
//
///** Zend_Search_Lucene_Search_Query_Wildcard */
//require_once 'Zend/Search/Lucene/Search/Query/Wildcard.php';
//
///** Zend_Search_Lucene_Search_Query_Range */
//require_once 'Zend/Search/Lucene/Search/Query/Range.php';
//
///** Zend_Search_Lucene_Search_Query_Fuzzy */
//require_once 'Zend/Search/Lucene/Search/Query/Fuzzy.php';
//
///** Zend_Search_Lucene_Search_Query_Boolean */
//require_once 'Zend/Search/Lucene/Search/Query/Boolean.php';
//
///** Zend_Search_Lucene_Search_Query_Empty */
//require_once 'Zend/Search/Lucene/Search/Query/Empty.php';
//
///** Zend_Search_Lucene_Search_Query_Insignificant */
//require_once 'Zend/Search/Lucene/Search/Query/Insignificant.php';
//



namespace app\modules\search\Lucene;

use app\modules\search\Lucene\LuceneInterface;
use app\modules\search\Lucene\Proxy;
use app\modules\search\Lucene\Document;
use app\modules\search\Lucene\Field;
use app\modules\search\Lucene\TermStreamsPriorityQueue;
use app\modules\search\Lucene\LockManager;
use app\modules\search\Index\Term;
use app\modules\search\Index\DocsFilter;
use app\modules\search\Index\SegmentInfo;
use app\modules\search\Index\Writer;
use app\modules\search\Storage\Directory;
use app\modules\search\Storage\Directory\Filesystem;
use app\modules\search\Search\QueryParser;
use app\modules\search\Search\Query;
use app\modules\search\Search\QueryHit;
use app\modules\search\Search\Similarity;

/**
 * @category   Zend
 * @package    Lucene
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Lucene implements LuceneInterface
{

    /**
     * Default field name for search
     *
     * Null means search through all fields
     *
     * @var string
     */
    private static $_defaultSearchField = null;

    /**
     * Result set limit
     *
     * 0 means no limit
     *
     * @var integer
     */
    private static $_resultSetLimit = 0;

    /**
     * Terms per query limit
     *
     * 0 means no limit
     *
     * @var integer
     */
    private static $_termsPerQueryLimit = 1024;

    /**
     * File system adapter.
     *
     * @var Directory
     */
    private $_directory = null;

    /**
     * File system adapter closing option
     *
     * @var boolean
     */
    private $_closeDirOnExit = true;

    /**
     * Writer for this index, not instantiated unless required.
     *
     * @var \Search\Index\Writer
     */
    private $_writer = null;

    /**
     * Array of SegmentInfo objects for current version of index.
     *
     * @var array SegmentInfo
     */
    private $_segmentInfos = array();

    /**
     * Number of documents in this index.
     *
     * @var integer
     */
    private $_docCount = 0;

    /**
     * Flag for index changes
     *
     * @var boolean
     */
    private $_hasChanges = false;

    /**
     * Signal, that index is already closed, changes are fixed and resources are cleaned up
     *
     * @var boolean
     */
    private $_closed = false;

    /**
     * Number of references to the index object
     *
     * @var integer
     */
    private $_refCount = 0;

    /**
     * Current segment generation
     *
     * @var integer
     */
    private $_generation;

    const FORMAT_PRE_2_1 = 0;
    const FORMAT_2_1 = 1;
    const FORMAT_2_3 = 2;

    /**
     * Index format version
     *
     * @var integer
     */
    private $_formatVersion;

    /**
     * Create index
     *
     * @param mixed $directory
     * @return LuceneInterface
     */
    public static function create($directory)
    {
        return new Proxy(new Lucene($directory, true));
    }

    /**
     * Open index
     *
     * @param mixed $directory
     * @return LuceneInterface
     */
    public static function open($directory)
    {
        return new Proxy(new Lucene($directory, false));
    }

    /** Generation retrieving counter */
    const GENERATION_RETRIEVE_COUNT = 10;

    /** Pause between generation retrieving attempts in milliseconds */
    const GENERATION_RETRIEVE_PAUSE = 50;

    /**
     * Get current generation number
     *
     * Returns generation number
     * 0 means pre-2.1 index format
     * -1 means there are no segments files.
     *
     * @param Directory $directory
     * @return integer
     * @throws Exception
     */
    public static function getActualGeneration(Directory $directory)
    {
        /**
         * Lucene uses segments.gen file to retrieve current generation number
         *
         * Apache Lucene index format documentation mentions this method only as a fallback method
         *
         * Nevertheless we use it according to the performance considerations
         *
         * @todo check if we can use some modification of Apache Lucene generation determination algorithm
         *       without performance problems
         */
        try {
            for ($count = 0; $count < self::GENERATION_RETRIEVE_COUNT; $count++) {
                // Try to get generation file
                $genFile = $directory->getFileObject('segments.gen', false);

                $format = $genFile->readInt();
                if ($format != (int) 0xFFFFFFFE) {
                    throw new Exception('Wrong segments.gen file format');
                }

                $gen1 = $genFile->readLong();
                $gen2 = $genFile->readLong();

                if ($gen1 == $gen2) {
                    return $gen1;
                }

                usleep(self::GENERATION_RETRIEVE_PAUSE * 1000);
            }

            // All passes are failed
            throw new Exception('Index is under processing now');
        } catch (Exception $e) {
            if (strpos($e->getMessage(), 'is not readable') !== false) {
                try {
                    // Try to open old style segments file
                    $segmentsFile = $directory->getFileObject('segments', false);

                    // It's pre-2.1 index
                    return 0;
                } catch (Exception $e) {
                    if (strpos($e->getMessage(), 'is not readable') !== false) {
                        return -1;
                    } else {
                        throw new Exception($e->getMessage(), $e->getCode(), $e);
                    }
                }
            } else {
                throw new Exception($e->getMessage(), $e->getCode(), $e);
            }
        }

        return -1;
    }

    /**
     * Get generation number associated with this index instance
     *
     * The same generation number in pair with document number or query string
     * guarantees to give the same result while index retrieving.
     * So it may be used for search result caching.
     *
     * @return integer
     */
    public function getGeneration()
    {
        return $this->_generation;
    }

    /**
     * Get segments file name
     *
     * @param integer $generation
     * @return string
     */
    public static function getSegmentFileName($generation)
    {
        if ($generation == 0) {
            return 'segments';
        }

        return 'segments_' . base_convert($generation, 10, 36);
    }

    /**
     * Get index format version
     *
     * @return integer
     */
    public function getFormatVersion()
    {
        return $this->_formatVersion;
    }

    /**
     * Set index format version.
     * Index is converted to this format at the nearest upfdate time
     *
     * @param int $formatVersion
     * @throws Exception
     */
    public function setFormatVersion($formatVersion)
    {
        if ($formatVersion != self::FORMAT_PRE_2_1 &&
                $formatVersion != self::FORMAT_2_1 &&
                $formatVersion != self::FORMAT_2_3) {

            throw new Exception('Unsupported index format');
        }

        $this->_formatVersion = $formatVersion;
    }

    /**
     * Read segments file for pre-2.1 Lucene index format
     *
     * @throws Exception
     */
    private function _readPre21SegmentsFile()
    {
        $segmentsFile = $this->_directory->getFileObject('segments');

        $format = $segmentsFile->readInt();

        if ($format != (int) 0xFFFFFFFF) {

            throw new Exception('Wrong segments file format');
        }

        // read version
        $segmentsFile->readLong();

        // read segment name counter
        $segmentsFile->readInt();

        $segments = $segmentsFile->readInt();

        $this->_docCount = 0;

        // read segmentInfos
        for ($count = 0; $count < $segments; $count++) {
            $segName = $segmentsFile->readString();
            $segSize = $segmentsFile->readInt();
            $this->_docCount += $segSize;

            $this->_segmentInfos[$segName] = new SegmentInfo($this->_directory, $segName, $segSize);
        }

        // Use 2.1 as a target version. Index will be reorganized at update time.
        $this->_formatVersion = self::FORMAT_2_1;
    }

    /**
     * Read segments file
     *
     * @throws Exception
     */
    private function _readSegmentsFile()
    {
        $segmentsFile = $this->_directory->getFileObject(self::getSegmentFileName($this->_generation));

        $format = $segmentsFile->readInt();

        if ($format == (int) 0xFFFFFFFC) {
            $this->_formatVersion = self::FORMAT_2_3;
        } else if ($format == (int) 0xFFFFFFFD) {
            $this->_formatVersion = self::FORMAT_2_1;
        } else {

            throw new Exception('Unsupported segments file format');
        }

        // read version
        $segmentsFile->readLong();

        // read segment name counter
        $segmentsFile->readInt();

        $segments = $segmentsFile->readInt();

        $this->_docCount = 0;

        // read segmentInfos
        for ($count = 0; $count < $segments; $count++) {
            $segName = $segmentsFile->readString();
            $segSize = $segmentsFile->readInt();

            // 2.1+ specific properties
            $delGen = $segmentsFile->readLong();

            if ($this->_formatVersion == self::FORMAT_2_3) {
                $docStoreOffset = $segmentsFile->readInt();

                if ($docStoreOffset != (int) 0xFFFFFFFF) {
                    $docStoreSegment = $segmentsFile->readString();
                    $docStoreIsCompoundFile = $segmentsFile->readByte();

                    $docStoreOptions = array('offset' => $docStoreOffset,
                        'segment' => $docStoreSegment,
                        'isCompound' => ($docStoreIsCompoundFile == 1));
                } else {
                    $docStoreOptions = null;
                }
            } else {
                $docStoreOptions = null;
            }

            $hasSingleNormFile = $segmentsFile->readByte();
            $numField = $segmentsFile->readInt();

            $normGens = array();
            if ($numField != (int) 0xFFFFFFFF) {
                for ($count1 = 0; $count1 < $numField; $count1++) {
                    $normGens[] = $segmentsFile->readLong();
                }


                throw new Exception('Separate norm files are not supported. Optimize index to use it with Lucene.');
            }

            $isCompoundByte = $segmentsFile->readByte();

            if ($isCompoundByte == 0xFF) {
                // The segment is not a compound file
                $isCompound = false;
            } else if ($isCompoundByte == 0x00) {
                // The status is unknown
                $isCompound = null;
            } else if ($isCompoundByte == 0x01) {
                // The segment is a compound file
                $isCompound = true;
            }

            $this->_docCount += $segSize;

            $this->_segmentInfos[$segName] = new SegmentInfo($this->_directory, $segName, $segSize, $delGen, $docStoreOptions, $hasSingleNormFile, $isCompound);
        }
    }

    /**
     * Opens the index.
     *
     * IndexReader constructor needs Directory as a parameter. It should be
     * a string with a path to the index folder or a Directory object.
     *
     * @param Filesystem|string $directory
     * @throws Exception
     */
    public function __construct($directory = null, $create = false)
    {
        if ($directory === null) {

            throw new Exception('No index directory specified');
        }

        if (is_string($directory)) {

            $this->_directory = new Filesystem($directory);
            $this->_closeDirOnExit = true;
        } else {
            $this->_directory = $directory;
            $this->_closeDirOnExit = false;
        }

        $this->_segmentInfos = array();

        // Mark index as "under processing" to prevent other processes from premature index cleaning
        LockManager::obtainReadLock($this->_directory);

        $this->_generation = self::getActualGeneration($this->_directory);

        if ($create) {

            try {
                LockManager::obtainWriteLock($this->_directory);
            } catch (Exception $e) {
                LockManager::releaseReadLock($this->_directory);

                if (strpos($e->getMessage(), 'Can\'t obtain exclusive index lock') === false) {
                    throw new Exception($e->getMessage(), $e->getCode(), $e);
                } else {
                    throw new Exception('Can\'t create index. It\'s under processing now', 0, $e);
                }
            }

            if ($this->_generation == -1) {
                // Directory doesn't contain existing index, start from 1
                $this->_generation = 1;
                $nameCounter = 0;
            } else {
                // Directory contains existing index
                $segmentsFile = $this->_directory->getFileObject(self::getSegmentFileName($this->_generation));
                $segmentsFile->seek(12); // 12 = 4 (int, file format marker) + 8 (long, index version)

                $nameCounter = $segmentsFile->readInt();
                $this->_generation++;
            }


            Writer::createIndex($this->_directory, $this->_generation, $nameCounter);

            LockManager::releaseWriteLock($this->_directory);
        }

        if ($this->_generation == -1) {

            throw new Exception('Index doesn\'t exists in the specified directory.');
        } else if ($this->_generation == 0) {
            $this->_readPre21SegmentsFile();
        } else {
            $this->_readSegmentsFile();
        }
    }

    /**
     * Close current index and free resources
     */
    private function _close()
    {
        if ($this->_closed) {
            // index is already closed and resources are cleaned up
            return;
        }

        $this->commit();

        // Release "under processing" flag
        LockManager::releaseReadLock($this->_directory);

        if ($this->_closeDirOnExit) {
            $this->_directory->close();
        }

        $this->_directory = null;
        $this->_writer = null;
        $this->_segmentInfos = null;

        $this->_closed = true;
    }

    /**
     * Add reference to the index object
     *
     * @internal
     */
    public function addReference()
    {
        $this->_refCount++;
    }

    /**
     * Remove reference from the index object
     *
     * When reference count becomes zero, index is closed and resources are cleaned up
     *
     * @internal
     */
    public function removeReference()
    {
        $this->_refCount--;

        if ($this->_refCount == 0) {
            $this->_close();
        }
    }

    /**
     * Object destructor
     */
    public function __destruct()
    {
        $this->_close();
    }

    /**
     * Returns an instance of Writer for the index
     *
     * @return Writer
     */
    private function _getIndexWriter()
    {
        if ($this->_writer === null) {

            $this->_writer = new Writer($this->_directory, $this->_segmentInfos, $this->_formatVersion);
        }

        return $this->_writer;
    }

    /**
     * Returns the Directory instance for this index.
     *
     * @return Directory
     */
    public function getDirectory()
    {
        return $this->_directory;
    }

    /**
     * Returns the total number of documents in this index (including deleted documents).
     *
     * @return integer
     */
    public function count()
    {
        return $this->_docCount;
    }

    /**
     * Returns one greater than the largest possible document number.
     * This may be used to, e.g., determine how big to allocate a structure which will have
     * an element for every document number in an index.
     *
     * @return integer
     */
    public function maxDoc()
    {
        return $this->count();
    }

    /**
     * Returns the total number of non-deleted documents in this index.
     *
     * @return integer
     */
    public function numDocs()
    {
        $numDocs = 0;

        foreach ($this->_segmentInfos as $segmentInfo) {
            $numDocs += $segmentInfo->numDocs();
        }

        return $numDocs;
    }

    /**
     * Checks, that document is deleted
     *
     * @param integer $id
     * @return boolean
     * @throws Exception    Exception is thrown if $id is out of the range
     */
    public function isDeleted($id)
    {
        $this->commit();

        if ($id >= $this->_docCount) {

            throw new Exception('Document id is out of the range.');
        }

        $segmentStartId = 0;
        foreach ($this->_segmentInfos as $segmentInfo) {
            if ($segmentStartId + $segmentInfo->count() > $id) {
                break;
            }

            $segmentStartId += $segmentInfo->count();
        }

        return $segmentInfo->isDeleted($id - $segmentStartId);
    }

    /**
     * Set default search field.
     *
     * Null means, that search is performed through all fields by default
     *
     * Default value is null
     *
     * @param string $fieldName
     */
    public static function setDefaultSearchField($fieldName)
    {
        self::$_defaultSearchField = $fieldName;
    }

    /**
     * Get default search field.
     *
     * Null means, that search is performed through all fields by default
     *
     * @return string
     */
    public static function getDefaultSearchField()
    {
        return self::$_defaultSearchField;
    }

    /**
     * Set result set limit.
     *
     * 0 (default) means no limit
     *
     * @param integer $limit
     */
    public static function setResultSetLimit($limit)
    {
        self::$_resultSetLimit = $limit;
    }

    /**
     * Get result set limit.
     *
     * 0 means no limit
     *
     * @return integer
     */
    public static function getResultSetLimit()
    {
        return self::$_resultSetLimit;
    }

    /**
     * Set terms per query limit.
     *
     * 0 means no limit
     *
     * @param integer $limit
     */
    public static function setTermsPerQueryLimit($limit)
    {
        self::$_termsPerQueryLimit = $limit;
    }

    /**
     * Get result set limit.
     *
     * 0 (default) means no limit
     *
     * @return integer
     */
    public static function getTermsPerQueryLimit()
    {
        return self::$_termsPerQueryLimit;
    }

    /**
     * Retrieve index maxBufferedDocs option
     *
     * maxBufferedDocs is a minimal number of documents required before
     * the buffered in-memory documents are written into a new Segment
     *
     * Default value is 10
     *
     * @return integer
     */
    public function getMaxBufferedDocs()
    {
        return $this->_getIndexWriter()->maxBufferedDocs;
    }

    /**
     * Set index maxBufferedDocs option
     *
     * maxBufferedDocs is a minimal number of documents required before
     * the buffered in-memory documents are written into a new Segment
     *
     * Default value is 10
     *
     * @param integer $maxBufferedDocs
     */
    public function setMaxBufferedDocs($maxBufferedDocs)
    {
        $this->_getIndexWriter()->maxBufferedDocs = $maxBufferedDocs;
    }

    /**
     * Retrieve index maxMergeDocs option
     *
     * maxMergeDocs is a largest number of documents ever merged by addDocument().
     * Small values (e.g., less than 10,000) are best for interactive indexing,
     * as this limits the length of pauses while indexing to a few seconds.
     * Larger values are best for batched indexing and speedier searches.
     *
     * Default value is PHP_INT_MAX
     *
     * @return integer
     */
    public function getMaxMergeDocs()
    {
        return $this->_getIndexWriter()->maxMergeDocs;
    }

    /**
     * Set index maxMergeDocs option
     *
     * maxMergeDocs is a largest number of documents ever merged by addDocument().
     * Small values (e.g., less than 10,000) are best for interactive indexing,
     * as this limits the length of pauses while indexing to a few seconds.
     * Larger values are best for batched indexing and speedier searches.
     *
     * Default value is PHP_INT_MAX
     *
     * @param integer $maxMergeDocs
     */
    public function setMaxMergeDocs($maxMergeDocs)
    {
        $this->_getIndexWriter()->maxMergeDocs = $maxMergeDocs;
    }

    /**
     * Retrieve index mergeFactor option
     *
     * mergeFactor determines how often segment indices are merged by addDocument().
     * With smaller values, less RAM is used while indexing,
     * and searches on unoptimized indices are faster,
     * but indexing speed is slower.
     * With larger values, more RAM is used during indexing,
     * and while searches on unoptimized indices are slower,
     * indexing is faster.
     * Thus larger values (> 10) are best for batch index creation,
     * and smaller values (< 10) for indices that are interactively maintained.
     *
     * Default value is 10
     *
     * @return integer
     */
    public function getMergeFactor()
    {
        return $this->_getIndexWriter()->mergeFactor;
    }

    /**
     * Set index mergeFactor option
     *
     * mergeFactor determines how often segment indices are merged by addDocument().
     * With smaller values, less RAM is used while indexing,
     * and searches on unoptimized indices are faster,
     * but indexing speed is slower.
     * With larger values, more RAM is used during indexing,
     * and while searches on unoptimized indices are slower,
     * indexing is faster.
     * Thus larger values (> 10) are best for batch index creation,
     * and smaller values (< 10) for indices that are interactively maintained.
     *
     * Default value is 10
     *
     * @param integer $maxMergeDocs
     */
    public function setMergeFactor($mergeFactor)
    {
        $this->_getIndexWriter()->mergeFactor = $mergeFactor;
    }

    /**
     * Performs a query against the index and returns an array
     * of QueryHit objects.
     * Input is a string or Query.
     *
     * @param QueryParser|string $query
     * @return array QueryHit
     * @throws Exception
     */
    public function find($query)
    {
        if (is_string($query)) {
            $query = QueryParser::parse($query);
        }

        if (!$query instanceof Query) {

            throw new Exception('Query must be a string or Query object');
        }

        $this->commit();

        $hits = array();
        $scores = array();
        $ids = array();

        $query = $query->rewrite($this)->optimize($this);

        $query->execute($this);

        $topScore = 0;



        foreach ($query->matchedDocs() as $id => $num) {
            $docScore = $query->score($id, $this);
            if ($docScore != 0) {
                $hit = new QueryHit($this);
                $hit->id = $id;
                $hit->score = $docScore;

                $hits[] = $hit;
                $ids[] = $id;
                $scores[] = $docScore;

                if ($docScore > $topScore) {
                    $topScore = $docScore;
                }
            }

            if (self::$_resultSetLimit != 0 && count($hits) >= self::$_resultSetLimit) {
                break;
            }
        }

        if (count($hits) == 0) {
            // skip sorting, which may cause a error on empty index
            return array();
        }

        if ($topScore > 1) {
            foreach ($hits as $hit) {
                $hit->score /= $topScore;
            }
        }

        if (func_num_args() == 1) {
            // sort by scores
            array_multisort($scores, SORT_DESC, SORT_NUMERIC, $ids, SORT_ASC, SORT_NUMERIC, $hits);
        } else {
            // sort by given field names

            $argList = func_get_args();
            $fieldNames = $this->getFieldNames();
            $sortArgs = array();

            // PHP 5.3 now expects all arguments to array_multisort be passed by
            // reference (if it's invoked through call_user_func_array());
            // since constants can't be passed by reference, create some placeholder variables.
            $sortReg = SORT_REGULAR;
            $sortAsc = SORT_ASC;
            $sortNum = SORT_NUMERIC;

            $sortFieldValues = array();


            for ($count = 1; $count < count($argList); $count++) {
                $fieldName = $argList[$count];

                if (!is_string($fieldName)) {
                    throw new Exception('Field name must be a string.');
                }

                if (strtolower($fieldName) == 'score') {
                    $sortArgs[] = &$scores;
                } else {
                    if (!in_array($fieldName, $fieldNames)) {
                        throw new Exception('Wrong field name.');
                    }

                    if (!isset($sortFieldValues[$fieldName])) {
                        $valuesArray = array();
                        foreach ($hits as $hit) {
                            try {
                                $value = $hit->getDocument()->getFieldValue($fieldName);
                            } catch (Exception $e) {
                                if (strpos($e->getMessage(), 'not found') === false) {
                                    throw new Exception($e->getMessage(), $e->getCode(), $e);
                                } else {
                                    $value = null;
                                }
                            }

                            $valuesArray[] = $value;
                        }

                        // Collect loaded values in $sortFieldValues
                        // Required for PHP 5.3 which translates references into values when source
                        // variable is destroyed
                        $sortFieldValues[$fieldName] = $valuesArray;
                    }

                    $sortArgs[] = &$sortFieldValues[$fieldName];
                }

                if ($count + 1 < count($argList) && is_integer($argList[$count + 1])) {
                    $count++;
                    $sortArgs[] = &$argList[$count];

                    if ($count + 1 < count($argList) && is_integer($argList[$count + 1])) {
                        $count++;
                        $sortArgs[] = &$argList[$count];
                    } else {
                        if ($argList[$count] == SORT_ASC || $argList[$count] == SORT_DESC) {
                            $sortArgs[] = &$sortReg;
                        } else {
                            $sortArgs[] = &$sortAsc;
                        }
                    }
                } else {
                    $sortArgs[] = &$sortAsc;
                    $sortArgs[] = &$sortReg;
                }
            }

            // Sort by id's if values are equal
            $sortArgs[] = &$ids;
            $sortArgs[] = &$sortAsc;
            $sortArgs[] = &$sortNum;

            // Array to be sorted
            $sortArgs[] = &$hits;

            // Do sort
            call_user_func_array('array_multisort', $sortArgs);
        }

        return $hits;
    }

    /**
     * Returns a list of all unique field names that exist in this index.
     *
     * @param boolean $indexed
     * @return array
     */
    public function getFieldNames($indexed = false)
    {
        $result = array();
        foreach ($this->_segmentInfos as $segmentInfo) {
            $result = array_merge($result, $segmentInfo->getFields($indexed));
        }
        return $result;
    }

    /**
     * Returns a Document object for the document
     * number $id in this index.
     *
     * @param integer|QueryHit $id
     * @return Document
     * @throws Exception    Exception is thrown if $id is out of the range
     */
    public function getDocument($id)
    {
        if ($id instanceof QueryHit) {
            /* @var $id QueryHit */
            $id = $id->id;
        }

        if ($id >= $this->_docCount) {

            throw new Exception('Document id is out of the range.');
        }

        $segmentStartId = 0;
        foreach ($this->_segmentInfos as $segmentInfo) {
            if ($segmentStartId + $segmentInfo->count() > $id) {
                break;
            }

            $segmentStartId += $segmentInfo->count();
        }

        $fdxFile = $segmentInfo->openCompoundFile('.fdx');
        $fdxFile->seek(($id - $segmentStartId) * 8, SEEK_CUR);
        $fieldValuesPosition = $fdxFile->readLong();

        $fdtFile = $segmentInfo->openCompoundFile('.fdt');
        $fdtFile->seek($fieldValuesPosition, SEEK_CUR);
        $fieldCount = $fdtFile->readVInt();

        $doc = new Document();
        for ($count = 0; $count < $fieldCount; $count++) {
            $fieldNum = $fdtFile->readVInt();
            $bits = $fdtFile->readByte();

            $fieldInfo = $segmentInfo->getField($fieldNum);

            if (!($bits & 2)) { // Text data
                $field = new Field($fieldInfo->name, $fdtFile->readString(), 'UTF-8', true, $fieldInfo->isIndexed, $bits & 1);
            } else {            // Binary data
                $field = new Field($fieldInfo->name, $fdtFile->readBinary(), '', true, $fieldInfo->isIndexed, $bits & 1, true);
            }

            $doc->addField($field);
        }

        return $doc;
    }

    /**
     * Returns true if index contain documents with specified term.
     *
     * Is used for query optimization.
     *
     * @param Term $term
     * @return boolean
     */
    public function hasTerm(Term $term)
    {
        foreach ($this->_segmentInfos as $segInfo) {
            if ($segInfo->getTermInfo($term) !== null) {
                return true;
            }
        }

        return false;
    }

    /**
     * Returns IDs of all documents containing term.
     *
     * @param Term $term
     * @param DocsFilter|null $docsFilter
     * @return array
     */
    public function termDocs(Term $term, $docsFilter = null)
    {
        $subResults = array();
        $segmentStartDocId = 0;

        foreach ($this->_segmentInfos as $segmentInfo) {
            $subResults[] = $segmentInfo->termDocs($term, $segmentStartDocId, $docsFilter);

            $segmentStartDocId += $segmentInfo->count();
        }

        if (count($subResults) == 0) {
            return array();
        } else if (count($subResults) == 1) {
            // Index is optimized (only one segment)
            // Do not perform array reindexing
            return reset($subResults);
        } else {
            $result = call_user_func_array('array_merge', $subResults);
        }

        return $result;
    }

    /**
     * Returns documents filter for all documents containing term.
     *
     * It performs the same operation as termDocs, but return result as
     * DocsFilter object
     *
     * @param Term $term
     * @param DocsFilter|null $docsFilter
     * @return DocsFilter
     */
    public function termDocsFilter(Term $term, $docsFilter = null)
    {
        $segmentStartDocId = 0;
        $result = new DocsFilter();

        foreach ($this->_segmentInfos as $segmentInfo) {
            $subResults[] = $segmentInfo->termDocs($term, $segmentStartDocId, $docsFilter);

            $segmentStartDocId += $segmentInfo->count();
        }

        if (count($subResults) == 0) {
            return array();
        } else if (count($subResults) == 1) {
            // Index is optimized (only one segment)
            // Do not perform array reindexing
            return reset($subResults);
        } else {
            $result = call_user_func_array('array_merge', $subResults);
        }

        return $result;
    }

    /**
     * Returns an array of all term freqs.
     * Result array structure: array(docId => freq, ...)
     *
     * @param Term $term
     * @param DocsFilter|null $docsFilter
     * @return integer
     */
    public function termFreqs(Term $term, $docsFilter = null)
    {
        $result = array();
        $segmentStartDocId = 0;
        foreach ($this->_segmentInfos as $segmentInfo) {
            $result += $segmentInfo->termFreqs($term, $segmentStartDocId, $docsFilter);

            $segmentStartDocId += $segmentInfo->count();
        }

        return $result;
    }

    /**
     * Returns an array of all term positions in the documents.
     * Result array structure: array(docId => array(pos1, pos2, ...), ...)
     *
     * @param Term $term
     * @param DocsFilter|null $docsFilter
     * @return array
     */
    public function termPositions(Term $term, $docsFilter = null)
    {
        $result = array();
        $segmentStartDocId = 0;
        foreach ($this->_segmentInfos as $segmentInfo) {
            $result += $segmentInfo->termPositions($term, $segmentStartDocId, $docsFilter);

            $segmentStartDocId += $segmentInfo->count();
        }

        return $result;
    }

    /**
     * Returns the number of documents in this index containing the $term.
     *
     * @param Term $term
     * @return integer
     */
    public function docFreq(Term $term)
    {
        $result = 0;
        foreach ($this->_segmentInfos as $segInfo) {
            $termInfo = $segInfo->getTermInfo($term);
            if ($termInfo !== null) {
                $result += $termInfo->docFreq;
            }
        }

        return $result;
    }

    /**
     * Retrive similarity used by index reader
     *
     * @return Similarity
     */
    public function getSimilarity()
    {
        return Similarity::getDefault();
    }

    /**
     * Returns a normalization factor for "field, document" pair.
     *
     * @param integer $id
     * @param string $fieldName
     * @return float
     */
    public function norm($id, $fieldName)
    {
        if ($id >= $this->_docCount) {
            return null;
        }

        $segmentStartId = 0;
        foreach ($this->_segmentInfos as $segInfo) {
            if ($segmentStartId + $segInfo->count() > $id) {
                break;
            }

            $segmentStartId += $segInfo->count();
        }

        if ($segInfo->isDeleted($id - $segmentStartId)) {
            return 0;
        }

        return $segInfo->norm($id - $segmentStartId, $fieldName);
    }

    /**
     * Returns true if any documents have been deleted from this index.
     *
     * @return boolean
     */
    public function hasDeletions()
    {
        foreach ($this->_segmentInfos as $segmentInfo) {
            if ($segmentInfo->hasDeletions()) {
                return true;
            }
        }

        return false;
    }

    /**
     * Deletes a document from the index.
     * $id is an internal document id
     *
     * @param integer|QueryHit $id
     * @throws Exception
     */
    public function delete($id)
    {
        if ($id instanceof QueryHit) {
            /* @var $id QueryHit */
            $id = $id->id;
        }

        if ($id >= $this->_docCount) {

            throw new Exception('Document id is out of the range.');
        }

        $segmentStartId = 0;
        foreach ($this->_segmentInfos as $segmentInfo) {
            if ($segmentStartId + $segmentInfo->count() > $id) {
                break;
            }

            $segmentStartId += $segmentInfo->count();
        }
        $segmentInfo->delete($id - $segmentStartId);

        $this->_hasChanges = true;
    }

    /**
     * Adds a document to this index.
     *
     * @param Document $document
     */
    public function addDocument(Document $document)
    {
        $this->_getIndexWriter()->addDocument($document);
        $this->_docCount++;

        $this->_hasChanges = true;
    }

    /**
     * Update document counter
     */
    private function _updateDocCount()
    {
        $this->_docCount = 0;
        foreach ($this->_segmentInfos as $segInfo) {
            $this->_docCount += $segInfo->count();
        }
    }

    /**
     * Commit changes resulting from delete() or undeleteAll() operations.
     *
     * @todo undeleteAll processing.
     */
    public function commit()
    {
        if ($this->_hasChanges) {
            $this->_getIndexWriter()->commit();

            $this->_updateDocCount();

            $this->_hasChanges = false;
        }
    }

    /**
     * Optimize index.
     *
     * Merges all segments into one
     */
    public function optimize()
    {
        // Commit changes if any changes have been made
        $this->commit();

        if (count($this->_segmentInfos) > 1 || $this->hasDeletions()) {
            $this->_getIndexWriter()->optimize();
            $this->_updateDocCount();
        }
    }

    /**
     * Returns an array of all terms in this index.
     *
     * @return array
     */
    public function terms()
    {
        $result = array();

        /** TermsPriorityQueue */
        require_once 'Zend/Search/Lucene/Index/TermsPriorityQueue.php';

        $segmentInfoQueue = new TermsPriorityQueue();

        foreach ($this->_segmentInfos as $segmentInfo) {
            $segmentInfo->resetTermsStream();

            // Skip "empty" segments
            if ($segmentInfo->currentTerm() !== null) {
                $segmentInfoQueue->put($segmentInfo);
            }
        }

        while (($segmentInfo = $segmentInfoQueue->pop()) !== null) {
            if ($segmentInfoQueue->top() === null ||
                    $segmentInfoQueue->top()->currentTerm()->key() !=
                    $segmentInfo->currentTerm()->key()) {
                // We got new term
                $result[] = $segmentInfo->currentTerm();
            }

            if ($segmentInfo->nextTerm() !== null) {
                // Put segment back into the priority queue
                $segmentInfoQueue->put($segmentInfo);
            }
        }

        return $result;
    }

    /**
     * Terms stream priority queue object
     *
     * @var TermStreamsPriorityQueue
     */
    private $_termsStream = null;

    /**
     * Reset terms stream.
     */
    public function resetTermsStream()
    {
        if ($this->_termsStream === null) {
            $this->_termsStream = new TermStreamsPriorityQueue($this->_segmentInfos);
        } else {
            $this->_termsStream->resetTermsStream();
        }
    }

    /**
     * Skip terms stream up to the specified term preffix.
     *
     * Prefix contains fully specified field info and portion of searched term
     *
     * @param Term $prefix
     */
    public function skipTo(Term $prefix)
    {
        $this->_termsStream->skipTo($prefix);
    }

    /**
     * Scans terms dictionary and returns next term
     *
     * @return Term|null
     */
    public function nextTerm()
    {
        return $this->_termsStream->nextTerm();
    }

    /**
     * Returns term in current position
     *
     * @return Term|null
     */
    public function currentTerm()
    {
        return $this->_termsStream->currentTerm();
    }

    /**
     * Close terms stream
     *
     * Should be used for resources clean up if stream is not read up to the end
     */
    public function closeTermsStream()
    {
        $this->_termsStream->closeTermsStream();
        $this->_termsStream = null;
    }

    /*     * ***********************************************************************
      @todo UNIMPLEMENTED
     * *********************************************************************** */

    /**
     * Undeletes all documents currently marked as deleted in this index.
     *
     * @todo Implementation
     */
    public function undeleteAll()
    {
        
    }

}
