<?php

use App\Teacher;
use App\Role;
use Illuminate\Database\Seeder;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('teachers')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $teacherRole = Role::where('name', 'teacher')->first();

        Teacher::create([
            'user_id' => $teacherRole->id,
        ]);
    }
}
