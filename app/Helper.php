<?php

namespace App;

use \Session;
use Illuminate\Database\Eloquent\Model;

class Helper extends Model
{
    /**
     * check if coupon is in favorites
     * @param  int $id coupon id
     * @return boolean     is coupon in favorites
     */
    public static function checkFavorites($id)
    {

        $favorites = Session::get('favorites');
        // if fvorites doesnt exist return false
        if (count($favorites->items) === 0) {
            return false;
        }

        return isset($favorites->items[$id]) ? true : false;
    }

    /**
     * generate link for favorites button
     * @param  int $id coupon id
     * @return string     route for favorites
     */
    public static function favoritesToggle($id)
    {
        return Helper::checkFavorites($id) ? 'favorites.remove' : 'favorites.add';

    }
}
