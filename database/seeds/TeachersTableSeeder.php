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
        DB::table('teachers')->truncate();

        $teacherRole = Role::where('name', 'teacher')->first();

        Teacher::create([
            'user_id' => $teacherRole->id,
        ]);
    }
}
