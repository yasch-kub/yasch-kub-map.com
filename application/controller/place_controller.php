<?php
class place_controller
{
    public static function action_put_markers(){
        $markers = place_model::getAllPlace();
        exit(json_encode($markers));
    }
}