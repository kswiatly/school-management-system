<?php


use App\Classes;
use App\Student;
use App\Teacher;
use App\Role;
use Illuminate\Database\Seeder;

class ClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classes')->truncate();

        $studentRole = Role::where('name', 'student')->first();
        $teacherRole = Role::where('name', 'teacher')->first();

        Classes::create([
            'name' => '0A',
            'description' => 'Test class A',
            'tutor_id' => $teacherRole->id,
            'chairman_id' => $studentRole->id,
        ]);

        Classes::create([
            'name' => '0B',
            'description' => 'Test class B',
            'tutor_id' => $teacherRole->id,
            'chairman_id' => $studentRole->id,
        ]);
    }
}
