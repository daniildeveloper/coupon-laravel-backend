<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * System setting store all kay - value data in database.
 * For example: support phone, owner post address or
 */
class SystemSetting extends Model
{
    protected $table = 'system_settings';

    /**
     * get system setting value
     * return empty string if database doesnt store data with this slug
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public static function getValue($slug)
    {
        $value = \DB::table("system_settings")->where("slug", $slug)->get();
        return count($value) > 0 ? $value[0] : '';
    }
}
