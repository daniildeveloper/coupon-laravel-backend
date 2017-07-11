<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Trash;
use Auth;
use DB;

class TrashController extends Controller
{
    /**
     * show trash
     * @return [type] [description]
     */
    public function showTrash()
    {
        $trash = Trash::all();

        return view("admin.trash.index", [
            'trash' => $trash,
        ]);
    }

    /**
     * Перемещает в корзину зпись из бд
     * @param  [type] $table [description]
     * @param  [type] $id    [description]
     * @return [type]        [description]
     */
    public function moveToTrash($table, $id)
    {

        //query to object to delete
        $toTrash = DB::table($table)->where("id", $id);

        // new trash row
        $trash          = new Trash();
        $trash->table   = $table;
        $trash->object  = serialize($toTrash->get()[0]);
        $trash->user_id = Auth::user()->id;
        $trash->save();

        // delete row from table
        DB::table($table)->where("id", $id)->delete();


        return redirect()->back();

    }

    /**
     * delete from trash
     * now ops to restore some it
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id)
    {
        DB::table("trashes")->where("id", $id)->delete();
        return redirect()->back();
    }

    /**
     * restore to work removed object
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function restore($id)
    {
        $toRestore = Trash::find($id);

        $obj = unserialize(Trash::find($id)->object);

        $obj = (array) $obj;
        DB::table($toRestore->table)->insert($obj);
        DB::table("trashes")->where("id", $id)->delete();
        return redirect()->back();
    }
}
