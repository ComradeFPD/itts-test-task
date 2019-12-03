<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MarksTest extends TestCase
{
    /**
     * @test Проверка на возможность поставить студенту оценку
     */
    public function can_mark_the_student()
    {
        $this->withoutExceptionHandling();
        $req = $this->post(route('marks.create-post'), [
            'student_id' => 3,
            'subject_title' => 'subject name',
            'mark' => 5
        ]);
        $req->assertStatus(302);
        $req->assertSessionHasNoErrors();
    }

    /**
     * @test Проверка на возмжность обновления оценки ученика
     */
    public function can_update_existing_mark()
    {
        $this->withoutExceptionHandling();
        $req = $this->post(route('marks.update-post'), [
            'mark_id' => 1,
            'subject_title' => 'New subject name',
            'mark' => 1
        ]);
        $req->assertStatus(302);
        $req->assertSessionHasNoErrors();
    }

    /**
     * @test Проверка на удаление существующей отметки
     */
    public function can_delete_existing_mark()
    {
        $this->withoutExceptionHandling();
        $req = $this->get(route('marks.delete', [
            'id' => 1
        ]));
        $req->assertStatus(302);
    }
}
