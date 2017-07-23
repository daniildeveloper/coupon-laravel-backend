<?php

use App\Model\UsersRole as Role;
use Illuminate\Database\Seeder;

class UsersRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new Role();
        $user->name = 'User';
        $user->slug = 'user';
        $user->role_code = 1;
        $user->save();

        $admin = new Role();
        $admin->name = 'Admin';
        $admin->slug = 'admin';
        $admin->role_code = 999;
        $admin->save();

        $seller = new Role();
        $seller->name = 'Company Owner';
        $seller->slug = 'seller';
        $seller->role_code = 100;
        $seller->save();

        $manager = new Role();
        $manager->name = 'Manager';
        $manager->slug = 'manager';
        $manager->role_code = 90;
        $manager->save();
    }
}
