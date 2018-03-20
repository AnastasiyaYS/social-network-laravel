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
        $i=1;
        while ($i<51)
        {
            DB::table('users')->insert([
                'name' => 'Имя '.$i,
                'lastName' => 'Фамилия '.$i,
                'email' => str_random(8).'@mail.ru',
                'password' => '123456',
            ]);
            $i++;
        }
    }
}

