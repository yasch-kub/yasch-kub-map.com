<?php

class Validation
{
    public static function clear($value)
    {
        return htmlspecialchars(strip_tags(trim($value)));
    }
}