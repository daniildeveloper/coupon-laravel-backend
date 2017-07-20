<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Favorites stored in database
 */
class Favorites extends Model
{
    protected $table = 'favorites';

    /**
     * items in favorites
     * @var array
     */
    public $items = array();

    public function __construct($old)
    {
        if ($old) {
            $this->items = $old->items;
        }
    }

    public function add($item, $id)
    {
        $storedItem = [
            "id"              => $id,
            'price'           => $item->price,
            'available_until' => $item->available_until, //store to get quickly to see time
            'item'            => $item,
            'qty'             => 0,
        ];

        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }

        $storedItem['qty']++;
        $this->items[$id] = $storedItem;
    }

    /**
     * remove item from favorites
     * @param  Object(Coupon) $item Coupon to add to favorites
     * @param  int $id   <i>$item</i> id
     * @return void
     */
    public function remove($item, $id)
    {
        $storedItem = [
            "id"              => $id,
            'price'           => $item->price,
            'available_until' => $item->available_until, //store to get quickly to see time
            'item'            => $item,
            'qty'             => 0,
        ];

        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }

        $storedItem['qty']--;
        $this->items[$id] = $storedItem;
    }
}
