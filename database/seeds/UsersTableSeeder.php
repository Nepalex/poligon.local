<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
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
        //
        $data = [
            [
                'name' => 'Автор неизвестен',
                'email' => 'author_unknown@gmail.com',
                'password' => bcrypt('secret'),
            ],
            [
                'name' => 'Автор',
                'email' => 'author@gmail.com',
                'password' => bcrypt('123'),
            ]
        ];

        DB::table('users')->insert($data);
    }
}
