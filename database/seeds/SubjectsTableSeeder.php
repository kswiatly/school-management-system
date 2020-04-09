<?php

use Illuminate\Database\Seeder;
use App\Subject;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('subjects')->truncate();
        DB::table('subject_teacher')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Subject::create([
            'name' => 'Mathematics',
            'description' => 'The study of numbers and shapes. As part of maths you learn amongst   other things algebra and geometry.',
        ]);

        Subject::create([
            'name' => 'Biology',
            'description' => 'The study of living things.',
        ]);

        Subject::create([
            'name' => 'Geography',
            'description' => 'The study of all the countries of the world, and mountains, seas and weather.',
        ]);

        DB::table('subject_teacher')->insert(['teacher_id' => 1, 'subject_id'=>1]);
    }
}
