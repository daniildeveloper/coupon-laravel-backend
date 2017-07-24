<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Model where save companies clients address book
 */
class Client extends Model
{
    protected $table = 'clients';

    /**
     * get array of sellers clients
     * @param  integer $sellerId 
     * @return array           array of clients list
     */
    public static function getSellersClients($sellerId) {
      return \DB::table('clients')->where('company_id', $sellerId)->paginate('15');
    }
}
