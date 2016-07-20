<?php
/**
 * Created by PhpStorm.
 * User: natali
 * Date: 15.07.16
 * Time: 13:01
 */
use Illuminate\Database\Seeder;

use App\User as User;

class UserSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        factory(User::class, 20)->create();

        User::create([
            'firstname' => 'admin',
            'lastname' => 'admin',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'password' => bcrypt('123456')]);

    }

}