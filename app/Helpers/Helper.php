<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Modules\Category\Entities\Category;

class Helper
{
    /**
     * @return bool
     */
    public static function wantsJsonResponse()
    {
        return Str::contains(request()->url(), 'api');
    }

    /**
     * @param $params
     * @param $pattern
     * @return array
     */
    public static function getExcept($params, $pattern)
    {
        $result = [];

        foreach ($params as $key => $value) {
            if (!Str::startsWith($key, $pattern)) {
                $result[$key] = $value;
            }
        }

        return $result;
    }

    /**
     * @param $params
     * @param $pattern
     * @return array
     */
    public static function getOnly($params, $pattern)
    {
        $result = [];

        foreach ($params as $key => $value) {
            if (Str::startsWith($key, $pattern)) {
                $result[$key] = $value;
            }
        }

        return $result;
    }

    /**
     * @param $slug
     * @return mixed
     */
    public static function getCategoryName($slug)
    {
        return Category::whereSlug($slug)->first()->name;
    }
}
