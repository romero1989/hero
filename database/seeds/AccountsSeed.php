<?php

use Illuminate\Database\Seeder;

class AccountsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
            'account' => 'Romero Gomes',
            'email' => 'romero.ufrr@gmail.com',
            'senha' => bcrypt('123'),
            'nick' => 'r0m3r0',
            'donate' => 90,
            'cargo' => 1,
            'data' => time(),
            'alteracao' => 's',
            'Prg Secreta' => 'Teste',
            'Res Secreta' => 'Teste',
            'senha numerica' => '1234',
            'CaveCode' => 'teste',
        ]);



    }
}
