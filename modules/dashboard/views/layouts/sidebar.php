<?php

use app\modules\dashboard\helpers\Sidebar;
use Yii;

/** @var \yii\web\View $this */
?>
<div id="main-menu" role="navigation" >
    <div id="main-menu-inner">
        <!--        <div class="menu-content top" id="menu-content-demo">           
                    <div>
                        <div class="text-bg"><span class="text-semibold">ozan rock</span></div>
        
                        <img src="<?php //echo Yii::getAlias('@web');        ?>/PixelAdmin/img/avatars/1.jpg" alt="" class="">
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
                            'url' => ['/member/member/index'],
                            'icon' => 'menu-icon fa fa-angle-double-right',
                            'options' => [
                                'id' => 'member'
                            ],
                        ],
                        [
                            'label' => 'Brevet Penghargaan',
                            'url' => ['/member/brevetaward/index'],
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
                    'label' => 'Akun',
                    'url' => ['#'],
                    'icon' => 'menu-icon fa fa-users'
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

