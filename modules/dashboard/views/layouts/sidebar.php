<?php

use app\modules\dashboard\helpers\Sidebar;
use Yii;

/** @var \yii\web\View $this */
?>
<div id="main-menu" role="navigation">
    <div id="main-menu-inner">
        <!--        <div class="menu-content top" id="menu-content-demo">
                                    <div>
                                        <div class="text-bg"><span class="text-semibold">ozan rock</span></div>
                        
                                        <img src="<?php //echo Yii::getAlias('@web');             ?>/PixelAdmin/img/avatars/1.jpg" alt="" class="">
                                        <div class="btn-group">                    
                                            <a href="#" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-user"></i></a>
                                            <a href="#" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-cog"></i></a>
                                            <a href="#" class="btn btn-xs btn-danger btn-outline dark"><i class="fa fa-power-off"></i></a>
                                        </div>
                                        <a href="#" class="close">&times;</a>
                                    </div>            
                                </div>  -->
        <?php
        echo Sidebar::widget([
            'options' => ['class' => 'navigation'],
            'items' => [
                [
                    'label' => 'Beranda',
                    'url' => ['/dashboard/dashboard/index', 'action' => 'dashboard-list'],
                    'icon' => 'menu-icon fa fa-dashboard',
                    'options' => [
                        'id' => 'dashboard'
                    ]
                ],
                [
                    'label' => 'Database',
                    'url' => '#',
                    'icon' => 'menu-icon fa fa-archive',
                    'options' => [
                        'id' => 'database'
                    ],
                    'items' => [
                        [
                            'label' => 'Anggota',
                            'url' => ['#'],
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'member'
                            ],
                            'items' => [
                                [
                                    'label' => 'PPI',
                                    'url' => ['/member/ppi/index', 'action' => 'member-ppi-list'],
                                    'icon' => 'menu-icon fa fa-angle-double-right',
                                    'options' => [
                                        'id' => 'ppi'
                                    ]
                                ],
                                [
                                    'label' => 'Paskibra',
                                    'url' => ['/member/paskibra/index', 'action' => 'member-paskibra-list'],
                                    'icon' => 'menu-icon fa fa-angle-double-right',
                                    'options' => [
                                        'id' => 'paskibra'
                                    ]
                                ],
                                [
                                    'label' => 'Capas',
                                    'url' => ['/member/capas/index', 'action' => 'member-capas-list'],
                                    'icon' => 'menu-icon fa fa-angle-double-right',
                                    'options' => [
                                        'id' => 'capas'
                                    ]
                                ],
                            ]
                        ],
                        [
                            'label' => 'Brevet Penghargaan',
                            'url' => ['/member/brevetaward/index', 'action' => 'member-brevet-list'],
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'appreciation'
                            ]
                        ],
                        [
                            'label' => 'Keterampilan Personal',
                            'url' => ['/member/lifeskill/index', 'action' => 'member-lifeskill-list'],
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'lifeskill'
                            ]
                        ],
                        [
                            'label' => 'Keterampilan Bahasa Asing',
                            'url' => ['/member/languageskill/index', 'action' => 'member-languageskill-list'],
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'langskill'
                            ]
                        ],
                        [
                            'label' => 'Sekolah',
                            'url' => ['/member/school/index', 'action' => 'member-school-list'],
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'school'
                            ]
                        ],
                        [
                            'label' => 'Daerah',
                            'url' => ['/member/area/index', 'action' => 'member-area-list'],
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'area'
                            ]
                        ],
                        [
                            'label' => 'Suku Bnagsa',
                            'url' => ['/member/tribe/index', 'action' => 'member-tribe-list'],
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'tribe'
                            ]
                        ]
                    ]
                ],
                [
                    'label' => 'Tulisan',
                    'url' => ['#'],
                    'icon' => 'menu-icon fa  fa-pencil',
                    'items' => [
                        [
                            'label' => 'Post',
                            'url' => ['/word/post/index', 'action' => 'word-post-list'],
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'post'
                            ]
                        ],
                        [
                            'label' => 'Kategori',
                            'url' => ['/word/category/index', 'action' => 'word-category-list'],
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'category'
                            ]
                        ],
                        [
                            'label' => 'Tag',
                            'url' => ['/word/tag/index', 'action' => 'word-tag-list'],
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'tag'
                            ]
                        ],
                    ]
                ],
                [
                    'label' => 'Halaman',
                    'url' => ['#'],
                    'icon' => 'menu-icon fa fa-files-o',
                    'items' => [
                        [
                            'label' => 'Semua Halaman',
                            'url' => ['#'],
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'pages'
                            ]
                        ],
                        [
                            'label' => 'Tambah Baru',
                            'url' => ['#'],
                            'icon' => 'menu-icon fa fa-angle-double-right'
                        ]
                    ]
                ],
                [
                    'label' => 'Media',
                    'url' => ['#'],
                    'icon' => 'menu-icon fa fa-briefcase',
                    'items' => [
                        [
                            'label' => 'Foto',
                            'url' => ["/filemanager/image/index", "action" => "filemanager-image-list"],
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'images'
                            ]
                        ],
                        [
                            'label' => 'Dokument',
                            'url' => ["/filemanager/document/index", "action" => "filemanager-document-list"],
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
                    'items' => [
                        [
                            'label' => 'Header',
                            'url' => '#',
                            'icon' => 'menu-icon fa fa-angle-double-right'
                        ],
                        [
                            'label' => 'Menu',
                            'url' => ['/appearance/menu/index','action'=>'appearance-menu-list'],
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'menu'
                            ]
                        ],
                        [
                            'label' => 'Widget',
                            'url' => '#',
                            'icon' => 'menu-icon fa fa-angle-double-right'
                        ]
                    ]
                ],
                [
                    'label' => 'Buku Tamu',
                    'url' => ['/guestbook/default/index', 'action' => 'guestbook-list'],
                    'icon' => 'menu-icon fa   fa-comments-o'
                ],
                [
                    'label' => 'Pengguna',
                    'url' => ['#'],
                    'icon' => 'menu-icon fa fa-users',
                    'options' => [
                        'id' => 'user'
                    ],
                    'items' => [
                        [
                            'label' => 'Akun',
                            'url' => '#',
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'account'
                            ]
                        ],
                        [
                            'label' => 'Log Akun',
                            'url' => ['/userlog/userlog/index', 'action' => 'user-log-list'],
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
        <div class="menu-content">

        </div>
    </div>
    <!-- / #main-menu-inner -->
</div>
<!-- / #main-menu -->

