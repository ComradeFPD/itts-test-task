<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class StudentsController extends Controller
{
    public function index()
    {
        $students = Student::paginate(10);
        return response()->view('students.all', [
            'students' => $students
        ]);
    }

    public function getCreate()
    {
        return response()->view('students.create');
    }

    public function postCreate(Request $request)
    {
        $data = $request->except('_token');

        $validator = $this->makeValidator($data);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        Student::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'patronymic' => $data['patronymic'],
            'birthday' => $data['birthday']
        ]);
        return redirect(route('students.view'));
    }

    public function getUpdate($id)
    {
        $student = Student::find($id);
        return response()->view('students.update', [
            'student' => $student
        ]);
    }

    public function postUpdate(Request $request)
    {
        $data = $request->except(['_token', 'student_id']);
        $validator = $this->makeValidator($data);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        $student = Student::find($request->student_id);
        $student->update($data);
        return redirect(route('students.view'));
    }

    public function getDelete($id)
    {
        Student::where('id', $id)->delete();
        return response()->json('', 200);
    }

    public function postAjaxSearch(Request $request)
    {
        $students = Student::where('surname', 'like', '%'.$request->q.'%')->paginate(100);
        return response()->json(\Illuminate\Support\Facades\View::make('students._table', [
            'students' => $students
        ])->render());
    }

    private function makeValidator($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|alpha',
            'surname' => 'required|alpha',
            'patronymic' => 'required|alpha',
            'birthday' => 'required|date'
        ]);
        return $validator;
    }

}
