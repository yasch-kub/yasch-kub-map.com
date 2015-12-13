<?php
    return array(
        'add_rating/([0-9]+)/([0-9]+)' => 'place/add_rating/$1/$2',
        'place/categories' => 'place/get_categories',
        'place/add' => 'place/add_place',
        'place' => 'place/put_markers',
        'user/show_details' => 'user/show_details',
        'user/add_comment' => 'user/add_comment',
        'user/login' => 'user/login',
        'user/registration' => 'user/registration',
        'logout' => 'user/logout',
        'statistic/get_table' => 'statistic/get_table',
        'statistic' => 'statistic/view',
        'admin/add/([0-9]+)' => 'admin/add/$1',
        'admin/remove/([0-9]+)' => 'admin/remove/$1',
        'admin' => 'admin/view',
        '' => 'page/view'
    );