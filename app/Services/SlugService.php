<?php

namespace App\Services;

class SlugService
{
    protected static $slug;
    public static function generate($model, $name)
    {
        $obj = 'App\\'. $model;
        self::$slug = str_replace(' ', '-', $name);
        $data = $obj::where('slug', self::$slug)->get();
        if ($data->count() > 0) {
            self::generate($model, $name . '-' . $data->count());
        }
        return strtolower(self::$slug);
    }
}
