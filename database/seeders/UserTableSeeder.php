<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'      => 'Unknown author',
                'email'     => 'author_unknow@g.g',
                'password'  => bcrypt(Str::random())
            ],
            [
                'name'      => 'Vitalik',
                'email'     => 'author@g.g',
                'password'  => bcrypt('111')
            ]
        ];

        \DB::table('users')->insert($data);
    }
}
