<?php

use App\Student;
use App\Role;
use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->truncate();

        $studentRole = Role::where('name', 'student')->first();

        Student::create([
            'user_id' => $studentRole->id,
            'class_id' => 1,
        ]);
    }
}
