<?php

class Validation
{
    /**
     * @param $value
     * @return string
     */
    public static function clear($value)
    {
        return htmlspecialchars(strip_tags(trim($value)));
    }
}