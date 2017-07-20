<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Model\Favorites;
use Illuminate\Http\Request;
use \DB;
use \Session;

class FavoritesController extends Controller
{

    /**
     * show favorites list
     * @return view view with favorites
     */
    public function index()
    {
        $favorites = array();
        if (Auth::user() === null) {
            $favorites = Session::has('favorites') ? Session::get('favorites') : array();
        } else {
            $oldFavoritesFromDB = DB::table('favorites')->where('user_id', Auth::user()->id)->get();
            $favorites          = count($oldFavoritesFromDB) > 0 ? $oldFavoritesFromDB[0] : array();
        }
        return view('favorites.index', [
            'favorites' => $favorites,
        ]);
    }

    /**
     * add coupon to favorites
     * @param Request $request
     * @param int  $id      coupon id
     */
    public function addToFavorites(Request $request, $id)
    {
        $coupon       = Coupon::find($id);
        $oldFavorites = null;

        // favorites are stored in local session if user isnt logged in,
        // and in database if user is logged in
        if (Auth::user() === null) {
            $oldFavorites = Session::has('favorites') ? Session::get('favorites') : array();
        } else {
            // TODO: store favorites in database
            // $oldFavoritesFromDB = DB::table('favorites')->where('user_id', Auth::user()->id)->get();
            // $oldFavorites       = count($oldFavoritesFromDB) > 0 ? $oldFavoritesFromDB[0] : array();
            //
            $oldFavorites = Session::has('favorites') ? Session::get('favorites') : array();
        }

        // add to favorites in session
        $favorites = new Favorites($oldFavorites);
        $favorites->add($coupon, $id);

        $request->session()->put('favorites', $favorites);
        return redirect()->back();
    }

    public function removeFromFavorites(Request $request, $id)
    {
        $coupon       = Coupon::find($id);
        $oldFavorites = null;

        // favorites are stored in local session if user isnt logged in,
        // and in database if user is logged in
        if (Auth::user() === null) {
            $oldFavorites = Session::has('favorites') ? Session::get('favorites') : array();
        } else {
            // TODO: store favorites in database
            // $oldFavoritesFromDB = DB::table('favorites')->where('user_id', Auth::user()->id)->get();
            // $oldFavorites       = count($oldFavoritesFromDB) > 0 ? $oldFavoritesFromDB[0] : array();
            //
            $oldFavorites = Session::has('favorites') ? Session::get('favorites') : array();
        }

        // add to favorites in session
        $favorites = new Favorites($oldFavorites);
        $favorites->remove($coupon, $id);

        $request->session()->put('favorites', $favorites);
        return redirect()->back();
    }
}
