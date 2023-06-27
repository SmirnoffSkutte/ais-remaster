<?php namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['id'=>1,'name'=>'user'],
            ['id'=>2,'name'=>'admin'],
        ]);
//        User::factory()->count(20)->create();
    }
}
