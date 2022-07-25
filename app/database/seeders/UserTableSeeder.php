<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Model\User::class, 5)->create()->each(function($user){
            $thread = factory(\App\Model\Thread::class, 3)->make();
            $user->threads()->saveMany($thread);
        });
    }
}
