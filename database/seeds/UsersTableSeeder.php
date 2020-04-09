<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::table('role_user')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $adminRole = Role::where('name', 'Admin')->first();
        $teacherRole = Role::where('name', 'Teacher')->first();
        $studentRole = Role::where('name', 'Student')->first();

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@school.com',
            'password' => Hash::make('admin_password'),
        ]);

        $teacher = User::create([
            'name' => 'Teacher',
            'email' => 'teacher@school.com',
            'password' => Hash::make('teacher_password'),
        ]);

        $student = User::create([
            'name' => 'Student',
            'email' => 'student@school.com',
            'password' => Hash::make('student_password'),
        ]);

        $admin->roles()->attach($adminRole);
        $teacher->roles()->attach($teacherRole);
        $student->roles()->attach($studentRole);
    }
}
