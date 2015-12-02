<?php
    return array(
        'add_rating/([0-9]+)/([0-9]+)' => 'place/add_rating/$1/$2',
        'place/categories' => 'place/get_categories',
        'place/add' => 'place/add_place',
        'place' => 'place/put_markers',
        '' => 'page/view'
    );