<?php

class statistic_model
{
    public static function getAllPlaceByCategory($category = '') {
        $db = Db::getConnection();
        if (!empty($category))
        {
            $query = sprintf("SELECT place.id, mark, place.name, address FROM place
                JOIN category ON place.category_id = category.id AND category.name = '%s'", $category);
            $place = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

            $query = sprintf("SELECT place.id, count(rating.id) as n_views FROM place
                JOIN category ON place.category_id = category.id AND category.name = '%s'
                JOIN rating ON place.id = rating.place_id GROUP BY place.id", $category);
            $n_views = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

            $query = sprintf("SELECT place.id, count(comment.id) as n_comments FROM place
                JOIN category ON place.category_id = category.id AND category.name = '%s'
                JOIN comment ON place.id = comment.place_id GROUP BY place.id", $category);
            $n_comments = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
            $query = "SELECT place.id, mark, place.name, address FROM place";
            $place = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

            $query = sprintf("SELECT place.id, count(rating.id) as n_views FROM place
                JOIN rating ON place.id = rating.place_id GROUP BY place.id", $category);
            $n_views = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

            $query = sprintf("SELECT place.id, count(comment.id) as n_comments FROM place
                JOIN comment ON place.id = comment.place_id GROUP BY place.id", $category);
            $n_comments = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
        }


        $result = [];

        foreach($place as $index => $place_value) {
            $result[$index] = [
                'name' => $place_value['name'],
                'address' => $place_value['address'],
                'mark' => $place_value['mark'] ? $place_value['mark'] : '0',
                'id' => $place_value['id']
            ];

            foreach ($n_views as $n_views_value)
                if ($n_views_value['id'] == $place_value['id']) {
                    $result[$index]['n_views'] = $n_views_value['n_views'];
                    break;
                }

            foreach ($n_comments as $n_comments_value) {
                if ($n_comments_value['id'] == $place_value['id']) {
                    $result[$index]['n_comments'] = $n_comments_value['n_comments'];
                    break;
                }
            }

            if (!isset($result[$index]['n_views']))
                $result[$index]['n_views'] = 0;

            if (!isset($result[$index]['n_comments']))
                $result[$index]['n_comments'] = 0;
        }

        return($result);
    }
}