<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(AccountsSeed::class);
        //$this->call(UsersTableSeeder::class);

         DB::table('roles')->insert([
            'nome' => 'Admin',
        ]);

        DB::table('roles')->insert([
            'nome' => 'Usuario',
        ]);

        DB::table('users')->insert([
            'name' => 'Romero Gomes',
            'email' => 'romero.ufrr@gmail.com',
            'role_id' => '1',
            'password' => bcrypt('secret'),
        ]);

        DB::table('users')->insert([
            'name' => 'Romero Gomes',
            'email' => 'romero.ufrr2@gmail.com',
            'role_id' => '2',
            'password' => bcrypt('secret'),
        ]);
    }
}
