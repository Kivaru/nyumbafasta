<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
          'role_id'   => '1',
          'name'      => 'Mr. Admin',
          // 'email'     => 'admin@gmail.com',
          'contact'     => '01670605075',
          'created_at' => '2020-09-18 13:20:14',
          'updated_at' => '2020-09-18 13:20:14',
          'password'  => bcrypt('11223344'),
        ]);

    DB::table('users')->insert([
          'role_id'   => '2',
          'name'      => 'Mr. Landlord',
          // 'email'     => 'landlord@gmail.com',
          'contact'     => '01970605076',
          'created_at' => '2020-09-18 13:20:14',
          'updated_at' => '2020-09-18 13:20:14',
          'password'  => bcrypt('11223344'),
        ]);

        DB::table('users')->insert([
          'role_id'   => '3',
          'name'      => 'Mr. Renter',
          // 'email'     => 'renter@gmail.com',
          'contact'     => '01870605075',
          'created_at' => '2020-09-18 13:20:14',
          'updated_at' => '2020-09-18 13:20:14',
          'password'  => bcrypt('11223344'),
        ]);


    }
}
