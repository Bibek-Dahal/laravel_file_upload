<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory as Factory;
use Illuminate\Support\Str;
class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $facker = Factory::create();
        DB::table('posts')->insert([
            'title' => $facker->jobTitle,
            'slug' =>Str::slug($facker->jobTitle),
            'description'=>$facker->paragraph,
            'photo'=> $facker->image('public/storage/photos',640,480, null, false),
            'user_id'=>12
        ]);
    }
}
