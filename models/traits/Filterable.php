<?php

include_once 'filters/FilterInterface.php';

trait Filterable
{
    public static function filter(FilterInterface $filter)
    {
        return $filter->apply();
    }
}
