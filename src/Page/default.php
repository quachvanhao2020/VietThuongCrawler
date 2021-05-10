<?php
return [
    [
        'label' => 'Home',
        'id' => 'home',
        'route' => 'home',
        'controller' => VietThuongWb\Controller\IndexController::class,
        'action' => 'index',
    ],
    [
        'label' => 'gioi-thieu',
        'id' => 'gioi-thieu',
        'action' => 'index',
        'controller' => VietThuongWb\Controller\IndexController::class,
        'route' => 'gioi-thieu',
    ],
    [
        'label' => 'san-pham',
        'id' => 'san-pham',
        'action' => 'index',
        'controller' => 'san-pham',
        'route' => 'san-pham',
    ],
    [
        'label' => 'giao-duc',
        'id' => 'giao-duc',
        'action' => 'index',
        'controller' => 'giao-duc',
        'route' => 'tu-van',
    ],
    [
        'label' => 'Cho thue',
        'id' => 'cho-thue',
        'action' => 'index',
        'controller' => 'cho-thue-nhac-cu-am-thanh-anh-sang',
        'route' => 'tu-van',
    ],
    [
        'label' => 'tin-tuc',
        'id' => 'tin-tuc',
        'action' => 'index',
        'controller' => 'tin-tuc',
        'route' => 'tu-van',
        'pages' => [
            [
                'label' => 'tu-van',
                'id' => 'tu-van',
                'action' => 'index',
                'controller' => 'tu-van',
                'route' => 'tu-van',
                //'active' => true,
            ],
            [
                'label' => 'su-kien',
                'id' => 'su-kien',
                'action' => 'index',
                'controller' => 'su-kien',
                'route' => 'tu-van',
            ],
            [
                'label' => 'video',
                'id' => 'video',
                'action' => 'index',
                'controller' => 'video',
                'route' => 'tu-van',
            ],
            [
                'label' => 'doi-tac',
                'id' => 'doi-tac',
                'action' => 'index',
                'controller' => 'doi-tac',
                'route' => 'tu-van',
            ],
        ],
    ],
    [
        'label' => 'tuyen-dung',
        'id' => 'tuyen-dung',
        'action' => 'index',
        'controller' => 'tuyen-dung',
        'route' => 'tu-van',
    ],
    [
        'label' => 'chi-nhanh',
        'id' => 'chi-nhanh',
        'action' => 'index',
        'controller' => 'chi-nhanh',
        'route' => 'tu-van',
    ],
    [
        'label' => 'lien-he',
        'id' => 'lien-he',
        'action' => 'index',
        'controller' => 'lien-he',
        'route' => 'tu-van',
    ],
    [
        'label' => 'mua-tra-gop',
        'id' => 'mua-tra-gop',
        'action' => 'index',
        'controller' => 'mua-tra-gop',
        'route' => 'tu-van',
    ],
    [
        'label' => 'chuong-trinh-the-viet-thuong-music-membership',
        'id' => 'membership',
        'action' => 'index',
        'controller' => 'chuong-trinh-the-viet-thuong-music-membership',
        'route' => 'tu-van',
    ],
    [
        'label' => 'dieu-khoan-su-dung-website',
        'id' => 'dieu-khoan',
        'action' => 'index',
        'controller' => 'dieu-khoan-su-dung-website',
        'route' => 'tu-van',
    ],
    [
        'label' => 'chinh-sach-doi-tra',
        'id' => 'chinh-sach-doi-tra',
        'action' => 'index',
        'controller' => 'chinh-sach-doi-tra',
        'route' => 'tu-van',
    ],
    [
        'label' => 'huong-dan-mua-hang',
        'id' => 'huong-dan-mua-hang',
        'action' => 'index',
        'controller' => 'huong-dan-mua-hang',
        'route' => 'tu-van',
    ],
    [
        'label' => 'chinh-sach-thanh-toan-va-bao-mat',
        'id' => 'chinh-sach-thanh-toan-va-bao-mat',
        'action' => 'index',
        'controller' => 'chinh-sach-thanh-toan-va-bao-mat',
        'route' => 'tu-van',
    ],
    [
        'label' => 'chinh-sach-bao-hanh',
        'id' => 'chinh-sach-bao-hanh',
        'action' => 'index',
        'controller' => 'chinh-sach-bao-hanh',
        'route' => 'tu-van',
    ],
    [
        'label' => 'bao-tri-dan-piano',
        'id' => 'bao-tri-dan-piano',
        'action' => 'index',
        'controller' => 'bao-tri-dan-piano',
        'route' => 'tu-van',
    ],
    [
        'label' => 'kich-hoat-bao-hanh',
        'id' => 'kich-hoat-bao-hanh',
        'action' => 'index',
        'controller' => 'kich-hoat-bao-hanh',
        'route' => 'tu-van',
    ],
];