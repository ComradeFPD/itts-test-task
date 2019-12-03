<?php

namespace Tests\Feature;

use App\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentTest extends TestCase
{
    /**
     * @test Проверка вывода списка студентов
     */

    public function can_view_students_list()
    {
        $this->withoutExceptionHandling();
        $req = $this->get('/students');
        $req->assertStatus(200);
    }

    /**
     * @test Проверка на добавление пользователя
     */

    public function can_create_new_students()
    {
        $this->withoutExceptionHandling();
        $req = $this->post(route('students.create-post'), [
            'name' => 'Test',
            'surname' => 'test',
            'patronymic' => 'test',
            'birthday' => '2019-07-22'
        ]);
        $req->assertStatus(302);
        $this->assertNotNull(Student::where('name', 'Test')->first());
    }

    /**
     * @test Проверка на добавление если не все поля заполнены/заполнены неверно
     */
    public function can_create_new_students_without_proper_values()
    {
        $this->withoutExceptionHandling();
        $req = $this->post(route('students.create-post'), [
            'surname' => 'test2',
            'birthday' => '2019-02-03'
        ]);
        $req->assertStatus(302);
        $req->assertSessionHasErrors();
        $req = $this->post(route('students.create-post'), [
            'name' => 12323,
            'surname' => 'qweqwe',
            'patronymic' => 'werwer',
            'birthday' => 1231231233
        ]);
        $req->assertStatus(302);
        $req->assertSessionHasErrors('name');
    }

    /**
     * @test Проверка на обновление записи студента
     */
    public function can_update_existing_student()
    {
        $this->withoutExceptionHandling();
        $req = $this->post(route('students.update-post'), [
            'student_id' => 3,
            'name' => 'New test name',
            'surname' => 'New test surname',
            'patronymic' => 'test',
            'birthday' => now()
        ]);
        $req->assertStatus(302);
    }

    /**
     * @test Проверка могу ли я удалить пользователя
     */
    public function can_delete_existing_student()
    {
        $this->withoutExceptionHandling();
        $req = $this->get(route('students.delete', [
            'id' => 4
        ]));
        $req->assertStatus(302);
    }
}
