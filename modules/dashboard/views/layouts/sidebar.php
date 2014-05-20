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
                
                                <img src="<?php //echo Yii::getAlias('@web');           ?>/PixelAdmin/img/avatars/1.jpg" alt="" class="">
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
                    'url' => ['/dashboard/dashboard/index'],
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
                                    'url' => ['/member/paskibra/index'],
                                    'icon' => 'menu-icon fa fa-angle-double-right',
                                    'options' => [
                                        'id' => 'paskibra'
                                    ]
                                ],
                                [
                                    'label' => 'Capas',
                                    'url' => ['/member/capas/index'],
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
                            'url' => ['/member/lifeskill/index'],
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'lifeskill'
                            ]
                        ],
                        [
                            'label' => 'Keterampilan Bahasa Asing',
                            'url' => ['/member/languageskill/index'],
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'langskill'
                            ]
                        ],
                        [
                            'label' => 'Sekolah',
                            'url' => ['/member/school/index'],
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'school'
                            ]
                        ],
                        [
                            'label' => 'Daerah',
                            'url' => ['/member/area/index'],
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'area'
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
                            'label' => 'Semua Tulisan',
                            'url' => ['#'],
                            'icon' => 'menu-icon fa fa-angle-double-right'
                        ],
                        [
                            'label' => 'Kategory',
                            'url' => ['#'],
                            'icon' => 'menu-icon fa fa-angle-double-right'
                        ],
                        [
                            'label' => 'Tag',
                            'url' => ['#'],
                            'icon' => 'menu-icon fa fa-angle-double-right'
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
                            'icon' => 'menu-icon fa fa-angle-double-right'
                        ],
                        [
                            'label' => 'Tambah Baru',
                            'url' => ['#'],
                            'icon' => 'menu-icon fa fa-angle-double-right'
                        ]
                    ]
                ],
                [
                    'label' => 'File Manager',
                    'url' => ['#'],
                    'icon' => 'menu-icon fa fa-briefcase',
                    'items' => [
                        [
                            'label' => 'Gambar',
                            'url' => ["/filemanager/image/index", "action" => "filemanager-image-list"],
                            'icon' => 'menu-icon fa fa-angle-double-right'
                        ],
                        [
                            'label' => 'Dokument',
                            'url' => ["/filemanager/document/index", "action" => "filemanager-document-list"],
                            'icon' => 'menu-icon fa fa-angle-double-right'
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
                            'url' => '#',
                            'icon' => 'menu-icon fa fa-angle-double-right'
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
                    'url' => '#',
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

