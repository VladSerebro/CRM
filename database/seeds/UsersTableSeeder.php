<?php

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
        $arr = array();
        array_push($arr,[
            'name' => 'Brus',
            'email' => 'brus@mail.com',
            'password' => '321321'
        ]);
        array_push($arr,[
            'name' => 'Vasia',
            'email' => 'vasia@mail.com',
            'password' => '321321'
        ]);
        array_push($arr,[
            'name' => 'Vold',
            'email' => 'vold@mail.com',
            'password' => '321321'
        ]);
        array_push($arr,[
            'name' => 'Kate',
            'email' => 'kate@mail.com',
            'password' => '321321'
        ]);
        array_push($arr,[
            'name' => 'Micael',
            'email' => 'micael@mail.com',
            'password' => '321321'
        ]);

        DB::table('users')->insert($arr);
    }
}
