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

        //------------------------------------ users

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        //------------------------------------ teachers

        $teacher1 = Teacher::factory()->create([
            'user_id' => $user1->id
        ]);

        $teacher2 = Teacher::factory()->create([
            'user_id' => $user2->id
        ]);

        //------------------------------------ students

        $student1 = Student::factory()->create([
            'teacher_id' => $teacher1->id
        ]);

        $student2 = Student::factory()->create([
            'teacher_id' => $teacher2->id
        ]);

        $student3 = Student::factory()->create([
            'teacher_id' => $teacher1->id
        ]);

        $student4 = Student::factory()->create([
            'teacher_id' => $teacher2->id
        ]);

        $student5 = Student::factory()->create([
            'teacher_id' => $teacher1->id
        ]);

        $student6 = Student::factory()->create([
            'teacher_id' => $teacher2->id
        ]);

        //------------------------------------ classes

        $classs1 = Classs::factory()->create([
            'name' => "Español I",
            'teacher_id' => $teacher1->id
        ]);

        $classs2 = Classs::factory()->create([
            'name' => "Matemáticas II",
            'teacher_id' => $teacher2->id
        ]);

        $classs3 = Classs::factory()->create([
            'name' => "Fisica I",
            'teacher_id' => $teacher1->id
        ]);

        $classs4 = Classs::factory()->create([
            'name' => "Taller de dibujo",
            'teacher_id' => $teacher2->id
        ]);

        //------------------------------------ class students

        ClassStudent::factory()->create([
            'classs_id' => $classs1->id,
            'student_id' => $student1->id,
        ]);

        ClassStudent::factory()->create([
            'classs_id' => $classs1->id,
            'student_id' => $student3->id,
        ]);

        ClassStudent::factory()->create([
            'classs_id' => $classs1->id,
            'student_id' => $student4->id,
        ]);

        ClassStudent::factory()->create([
            'classs_id' => $classs2->id,
            'student_id' => $student2->id,
        ]);

        ClassStudent::factory()->create([
            'classs_id' => $classs4->id,
            'student_id' => $student1->id,
        ]);

        ClassStudent::factory()->create([
            'classs_id' => $classs4->id,
            'student_id' => $student2->id,
        ]);

        ClassStudent::factory()->create([
            'classs_id' => $classs4->id,
            'student_id' => $student3->id,
        ]);

        ClassStudent::factory()->create([
            'classs_id' => $classs4->id,
            'student_id' => $student4->id,
        ]);

        ClassStudent::factory()->create([
            'classs_id' => $classs4->id,
            'student_id' => $student5->id,
        ]);

        //------------------------------------ evaluations

        $evaluation1 = Evaluation::factory()->create([
            'classs_id' => $classs1->id,
            'name' => "Trabajos",
            'value' => 40
        ]);

        $evaluation2 = Evaluation::factory()->create([
            'classs_id' => $classs1->id,
            'name' => "Examen",
            'value' => 30
        ]);

        $evaluation3 = Evaluation::factory()->create([
            'classs_id' => $classs1->id,
            'name' => "Proyecto",
            'value' => 30
        ]);

        $evaluation4 = Evaluation::factory()->create([
            'classs_id' => $classs2->id,
            'name' => "Actividades",
            'value' => 80
        ]);

        $evaluation5 = Evaluation::factory()->create([
            'classs_id' => $classs2->id,
            'name' => "Participaciones",
            'value' => 10
        ]);

        $evaluation6 = Evaluation::factory()->create([
            'classs_id' => $classs2->id,
            'name' => "Asistencia",
            'value' => 10
        ]);

        $evaluation7 = Evaluation::factory()->create([
            'classs_id' => $classs3->id,
            'name' => "Clase",
            'value' => 100
        ]);

        $evaluation8 = Evaluation::factory()->create([
            'classs_id' => $classs4->id,
            'name' => "Examen",
            'value' => 100
        ]);

        //------------------------------------ assignations

        $assignation1 = Assignation::factory()->create([
            'name' => "Trabajo 1 de Español I",
            'classs_id' => $classs1->id,
            'evaluation_id' => $evaluation1->id
        ]);

        $assignation2 = Assignation::factory()->create([
            'name' => "Examen 1er bimestre de Español I",
            'classs_id' => $classs1->id,
            'evaluation_id' => $evaluation2->id
        ]);

        $assignation3 = Assignation::factory()->create([
            'name' => "Proyecto 1er bimestre de Español I",
            'classs_id' => $classs1->id,
            'evaluation_id' => $evaluation3->id
        ]);

        $assignation4 = Assignation::factory()->create([
            'name' => "Act 1 trigonometria",
            'classs_id' => $classs2->id,
            'evaluation_id' => $evaluation4->id
        ]);

        $assignation5 = Assignation::factory()->create([
            'name' => "Participacion de Matematicas II",
            'classs_id' => $classs2->id,
            'evaluation_id' => $evaluation5->id
        ]);

        $assignation6 = Assignation::factory()->create([
            'name' => "Examen de Matematicas II",
            'classs_id' => $classs2->id,
            'evaluation_id' => $evaluation6->id
        ]);

        $assignation7 = Assignation::factory()->create([
            'name' => "Realizar Mona Lisa a manito y sin lapiz",
            'classs_id' => $classs4->id,
            'evaluation_id' => $evaluation8->id
        ]);

        //------------------------------------ grades

        // student 1

        $valsBase100 = [60,70,75,80,85,90,95,100];
        $valsBase10 = [6,7,8,9,10];

        Grade::factory()->create([
            'student_id' => $student1->id,
            'value' => ($assignation1->classs->base == 100) ? rand(60, 100) : rand(6, 10),
            'assignation_id' => $assignation1->id
        ]);

        Grade::factory()->create([
            'student_id' => $student1->id,
            'value' => ($assignation2->classs->base == 100) ? rand(60, 100) : rand(6, 10),
            'assignation_id' => $assignation2->id
        ]);

        Grade::factory()->create([
            'student_id' => $student1->id,
            'value' => ($assignation7->classs->base == 100) ? rand(60, 100) : rand(6, 10),
            'assignation_id' => $assignation7->id
        ]);

        // student 3

        Grade::factory()->create([
            'student_id' => $student3->id,
            'value' => ($assignation1->classs->base == 100) ? rand(60, 100) : rand(6, 10),
            'assignation_id' => $assignation1->id
        ]);

        Grade::factory()->create([
            'student_id' => $student3->id,
            'value' => ($assignation3->classs->base == 100) ? rand(60, 100) : rand(6, 10),
            'assignation_id' => $assignation3->id
        ]);

        Grade::factory()->create([
            'student_id' => $student3->id,
            'value' => ($assignation7->classs->base == 100) ? rand(60, 100) : rand(6, 10),
            'assignation_id' => $assignation7->id
        ]);

        // student 4

        Grade::factory()->create([
            'student_id' => $student4->id,
            'value' => ($assignation1->classs->base == 100) ? rand(60, 100) : rand(6, 10),
            'assignation_id' => $assignation1->id
        ]);

        Grade::factory()->create([
            'student_id' => $student4->id,
            'value' => ($assignation2->classs->base == 100) ? rand(60, 100) : rand(6, 10),
            'assignation_id' => $assignation2->id
        ]);

        Grade::factory()->create([
            'student_id' => $student4->id,
            'value' => ($assignation3->classs->base == 100) ? rand(60, 100) : rand(6, 10),
            'assignation_id' => $assignation3->id
        ]);

        Grade::factory()->create([
            'student_id' => $student4->id,
            'value' => ($assignation7->classs->base == 100) ? rand(60, 100) : rand(6, 10),
            'assignation_id' => $assignation7->id
        ]);

        // student 2

        Grade::factory()->create([
            'student_id' => $student2->id,
            'value' => ($assignation4->classs->base == 100) ? rand(60, 100) : rand(6, 10),
            'assignation_id' => $assignation4->id
        ]);

        Grade::factory()->create([
            'student_id' => $student2->id,
            'value' => ($assignation5->classs->base == 100) ? rand(60, 100) : rand(6, 10),
            'assignation_id' => $assignation5->id
        ]);

        Grade::factory()->create([
            'student_id' => $student2->id,
            'value' => ($assignation7->classs->base == 100) ? rand(60, 100) : rand(6, 10),
            'assignation_id' => $assignation7->id
        ]);

        // student 5

        Grade::factory()->create([
            'student_id' => $student5->id,
            'value' => ($assignation7->classs->base == 100) ? rand(60, 100) : rand(6, 10),
            'assignation_id' => $assignation7->id
        ]);


    }
}
