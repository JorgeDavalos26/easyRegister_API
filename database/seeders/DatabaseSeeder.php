<?php

namespace Database\Seeders;

use App\Models\Assignation;
use App\Models\Classs;
use App\Models\ClassStudent;
use App\Models\Evaluation;
use App\Models\Evaluations;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // users

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        // teachers

        $teacher1 = Teacher::factory()->create([
            'user_id' => $user1->id
        ]);

        $teacher2 = Teacher::factory()->create([
            'user_id' => $user2->id
        ]);

        // students

        $student1 = Student::factory()->create([
            'teacher_id' => $teacher1->id
        ]);

        $student2 = Student::factory()->create([
            'teacher_id' => $teacher2->id
        ]);

        // classes

        $classs1 = Classs::factory()->create([
            'teacher_id' => $teacher1->id
        ]);

        $classs2 = Classs::factory()->create([
            'teacher_id' => $teacher2->id
        ]);

        // class students

        ClassStudent::factory()->create([
            'classs_id' => $classs1->id,
            'student_id' => $student1->id,
        ]);

        ClassStudent::factory()->create([
            'classs_id' => $classs2->id,
            'student_id' => $student2->id,
        ]);

        // evaluations

        $evaluation1 = Evaluation::factory(3)->create([
            'classs_id' => $classs1->id,
        ]);

        $evaluation2 = Evaluation::factory(3)->create([
            'classs_id' => $classs2->id,
        ]);

        //assignations

        $assignation1 = Assignation::factory()->create([
            'classs_id' => $classs1->id,
            'evaluation_id' => $evaluation1->id
        ]);

        $assignation2 = Assignation::factory()->create([
            'classs_id' => $classs2->id,
            'evaluation_id' => $evaluation2->id
        ]);

        // grades

        Grade::factory()->create([
            'student_id' => $student1->id,
            'assignation_id' => $assignation1->id
        ]);

        Grade::factory()->create([
            'student_id' => $student2->id,
            'assignation_id' => $assignation2->id
        ]);

    }
}
