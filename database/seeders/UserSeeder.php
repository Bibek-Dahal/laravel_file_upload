<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Factory;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {   $facker = Factory::create();
        for($i=0;$i<10;$i++){
            DB::table('users')->insert([
                'email' => $facker->email(),
                'first_name'=>$facker->name(),
                'last_name'=>$facker->lastName(),
                'password' => Hash::make($facker->password()),
                'city'  => $facker->city()
            ]);
        }
    }
}
