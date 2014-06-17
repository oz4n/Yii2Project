<?php

use app\modules\dashboard\helpers\Sidebar;
use Yii;

/** @var \yii\web\View $this */
?>
<div id="main-menu" role="navigation">
    <div id="main-menu-inner">
        <?php
        echo Sidebar::widget([
            'options' => ['class' => 'navigation'],
            'items' => [
                [
                    'label' => 'Beranda',
                    'url' => ['/dashboard/dashboard/index', 'action' => 'dashboard-list'],
                    'icon' => 'menu-icon fa fa-dashboard',
                    'visible' => Yii::$app->user->can('dashboardindex'),
                    'options' => [
                        'id' => 'dashboard'
                    ]
                ],
                [
                    'label' => 'Database',
                    'url' => '#',
                    'icon' => 'menu-icon fa fa-archive',
                    'visible' => Yii::$app->user->can('databasemenu'),
                    'options' => [
                        'id' => 'database'
                    ],
                    'items' => [
                        [
                            'label' => 'Anggota',
                            'url' => ['#'],
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'visible' => Yii::$app->user->can('membermenu'),
                            'options' => [
                                'id' => 'member'
                            ],
                            'items' => [
                                [
                                    'label' => 'PPI',
                                    'url' => ['/member/ppi/index', 'action' => 'member-ppi-list'],
                                    'icon' => 'menu-icon fa fa-angle-double-right',
                                    'visible' => Yii::$app->user->can('ppiindex'),
                                    'options' => [
                                        'id' => 'ppi'
                                    ]
                                ],
                                [
                                    'label' => 'Paskibra',
                                    'url' => ['/member/paskibra/index', 'action' => 'member-paskibra-list'],
                                    'icon' => 'menu-icon fa fa-angle-double-right',
                                    'visible' => Yii::$app->user->can('paskibraindex'),
                                    'options' => [
                                        'id' => 'paskibra'
                                    ]
                                ],
                                [
                                    'label' => 'Capas',
                                    'url' => ['/member/capas/index', 'action' => 'member-capas-list'],
                                    'icon' => 'menu-icon fa fa-angle-double-right',
                                    'visible' => Yii::$app->user->can('capasindex'),
                                    'options' => [
                                        'id' => 'capas'
                                    ]
                                ],
                            ]
                        ],
                        [
                            'label' => 'Brevet Penghargaan',
                            'url' => ['/member/brevetaward/index', 'action' => 'member-brevet-list'],
                            'visible' => Yii::$app->user->can('brevetawardindex'),
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'appreciation'
                            ]
                        ],
                        [
                            'label' => 'Keterampilan Personal',
                            'visible' => Yii::$app->user->can('lifeskillindex'),
                            'url' => ['/member/lifeskill/index', 'action' => 'member-lifeskill-list'],
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'lifeskill'
                            ]
                        ],
                        [
                            'label' => 'Keterampilan Bahasa Asing',
                            'visible' => Yii::$app->user->can('languageskillindex'),
                            'url' => ['/member/languageskill/index', 'action' => 'member-languageskill-list'],
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'langskill'
                            ]
                        ],
                        [
                            'label' => 'Sekolah',
                            'visible' => Yii::$app->user->can('schoolindex'),
                            'url' => ['/member/school/index', 'action' => 'member-school-list'],
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'school'
                            ]
                        ],
                        [
                            'label' => 'Daerah',
                            'url' => ['/member/area/index', 'action' => 'member-area-list'],
                            'visible' => Yii::$app->user->can('areaindex'),
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'area'
                            ]
                        ],
                        [
                            'label' => 'Suku Bnagsa',
                            'url' => ['/member/tribe/index', 'action' => 'member-tribe-list'],
                            'visible' => Yii::$app->user->can('tribendex'),
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'tribe'
                            ]
                        ],
                        [
                            'label' => 'Alat',
                            'url' => ['#'],
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'visible' => Yii::$app->user->can('toolsmenu'),
                            'options' => [
                                'id' => 'tools'
                            ],
                            'items' => [
                                [
                                    'label' => 'Impor',
                                    'url' => ['/member/tools/import', 'action' => 'member-tools-import'],
                                    'icon' => 'menu-icon fa fa-angle-double-right',
                                    'visible' => Yii::$app->user->can('toolsimport'),
                                    'options' => [
                                        'id' => 'tools-import'
                                    ]
                                ],
                                [
                                    'label' => 'Ekspor',
                                    'url' => ['/member/tools/export', 'action' => 'member-tools-export'],
                                    'visible' => Yii::$app->user->can('toolsexport'),
                                    'icon' => 'menu-icon fa fa-angle-double-right',
                                    'options' => [
                                        'id' => 'tools-export'
                                    ]
                                ]
                            ]
                        ],
                    ]
                ],
                [
                    'label' => 'Tulisan',
                    'url' => ['#'],
                    'icon' => 'menu-icon fa  fa-pencil',
                    'visible' => Yii::$app->user->can('postmenu'),
                    'items' => [
                        [
                            'label' => 'Post',
                            'url' => ['/word/post/index', 'action' => 'word-post-list'],
                            'visible' => Yii::$app->user->can('postindex'),
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'post'
                            ]
                        ],
                        [
                            'label' => 'Kategori',
                            'url' => ['/word/category/index', 'action' => 'word-category-list'],
                            'visible' => Yii::$app->user->can('categoryindex'),
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'category'
                            ]
                        ],
                        [
                            'label' => 'Tag',
                            'url' => ['/word/tag/index', 'action' => 'word-tag-list'],
                            'visible' => Yii::$app->user->can('tagindex'),
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'tag'
                            ]
                        ],
                    ]
                ],
                [
                    'label' => 'Halaman',
                    'url' => ['/page/page/index', 'action' => 'page-list'],
                    'icon' => 'menu-icon fa fa-files-o',
                    'visible' => Yii::$app->user->can('pageindex'),
                    'options' => [
                        'id' => 'pages'
                    ]
                ],
                [
                    'label' => 'Media',
                    'url' => ['#'],
                    'icon' => 'menu-icon fa fa-briefcase',
                    'visible' => Yii::$app->user->can('mediamenu'),
                    'items' => [
                        [
                            'label' => 'Foto',
                            'url' => ["/filemanager/image/index", "action" => "filemanager-image-list"],
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'visible' => Yii::$app->user->can('imageindex'),
                            'options' => [
                                'id' => 'images'
                            ]
                        ],
                        [
                            'label' => 'Dokument',
                            'url' => ["/filemanager/document/index", "action" => "filemanager-document-list"],
                            'visible' => Yii::$app->user->can('documentindex'),
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'document'
                            ]
                        ],
                    ]
                ],
                [
                    'label' => 'Tampilan',
                    'url' => ['#'],
                    'icon' => 'menu-icon fa fa-leaf',
                    'visible' => Yii::$app->user->can('appearancemenu'),
                    'items' => [
                        [
                            'label' => 'Umum',
                            'url' => ['/appearance/general/index', 'action' => 'appearance-general-list'],
//                            'visible' => Yii::$app->user->can('generalindex'),
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'general'
                            ]
                        ],
                        [
                            'label' => 'Menu',
                            'url' => ['/appearance/menu/index', 'action' => 'appearance-menu-list'],
                            'visible' => Yii::$app->user->can('menuindex'),
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'menu'
                            ]
                        ],
                        [
                            'label' => 'Widget',
                            'url' => ['/appearance/widget/index', 'action' => 'appearance-widget-list'],
                            'visible' => Yii::$app->user->can('widgetindex'),
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'widget'
                            ]
                        ]
                    ]
                ],
                [
                    'label' => 'Buku Tamu',
                    'url' => ['/guestbook/guestbook/index', 'action' => 'guestbook-list'],
                    'icon' => 'menu-icon fa   fa-comments-o',
                    'visible' => Yii::$app->user->can('guestbookindex'),
                    'options' => [
                        'id' => 'guestbook'
                    ],
                ],
                [
                    'label' => 'Pengguna',
                    'url' => ['#'],
                    'icon' => 'menu-icon fa fa-users',
                    'visible' => Yii::$app->user->can('usermenu'),
                    'options' => [
                        'id' => 'user'
                    ],
                    'items' => [
                        [
                            'label' => 'Akun',
                            'url' => ['/user/admin/index', 'action' => 'user-list'],
//                            'visible' => Yii::$app->user->can('adminindex'),
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'account'
                            ]
                        ],
                        [
                            'label' => 'Hak Akses',
                            'url' => ['/userrbac/rule/index', 'action' => 'user-rule-list'],
                            'visible' => Yii::$app->user->can('ruleindex'),
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'rule-account'
                            ]
                        ],
                        [
                            'label' => 'Log Akun',
                            'url' => ['/userlog/userlog/index', 'action' => 'user-log-list'],
                            'visible' => Yii::$app->user->can('userlogindex'),
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'log-account'
                            ]
                        ]
                    ]
                ],
            ],
        ]);
        ?>
        <div class="menu-content"></div>
    </div>
</div>

