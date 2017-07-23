<?php

namespace App;
use \DB;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    protected $table = 'managers';

    /**
     * each company can have managers. So return managersto it
     * @param  int $companyId company id
     * @return array           array of users worked as managers in company
     */
    public static function getCompanieManagers($companyId) {
      $managersList =  DB::table('managers')->where('company_id', $companyId)->get();
      $managers = array();
      foreach ($managersList as $managerId) {
        $managers[] = User::find($managerId->user_id);
      }
      return $managers;
    }
}
