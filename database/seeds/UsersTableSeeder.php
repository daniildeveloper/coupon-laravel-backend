<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = bcrypt('1234567890');
        // // my admin account for app
        $admin           = new User();
        $admin->name     = 'Daniil';
        $admin->email    = 'daniilborowkow@ya.ru';
        $admin->password = bcrypt('1234567890');
        $admin->role     = 999;
        $admin->save();

        // admin account demo
        $demoAdmin           = new User();
        $demoAdmin->name     = 'Admin';
        $demoAdmin->email    = 'admin@admin.com';
        $demoAdmin->password = bcrypt('1234567890');
        $demoAdmin->role     = 999;
        $demoAdmin->save();

        // seller
        $shopOwner           = new User();
        $shopOwner->name     = 'Director';
        $shopOwner->email    = 'director@someshop.com';
        $shopOwner->password = $password;
        $shopOwner->role     = 100;
        $shopOwner->save();

        // demo user
        $user1           = new User();
        $user1->name     = 'User';
        $user1->email    = 'some@some.com';
        $user1->password = $password;
        $user1->save();
    }
}
