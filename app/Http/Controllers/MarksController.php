<?php

namespace App\Http\Controllers;

use App\Student;
use App\StudentMark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarksController extends Controller
{
    public function index($id)
    {
        $marks = StudentMark::where('student_id', $id)->paginate(10);
        $student = Student::find($id);
        return response()->view('marks.index', [
            'marks' => $marks,
            'student' => $student
        ]);
    }

    public function getCreate()
    {
        $students = Student::all();
        return response()->view('marks.create', [
            'students' => $students
        ]);
    }

    public function postCreate(Request $request)
    {
        $data = $request->except('_token');
        $validator = $this->makeValidator($data);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        StudentMark::create([
            'student_id' => $data['student_id'],
            'subject_title' => $data['subject_title'],
            'mark' => $data['mark']
        ]);
        return redirect(route('marks.view'));
    }

    public function getUpdate($id)
    {
        $mark = StudentMark::find($id);
        $students = Student::all();
        return response()->view('marks.update', [
            'mark' => $mark,
            'students' => $students
        ]);
    }

    public function postUpdate(Request $request)
    {
        $data = $request->except(['_token', 'mark_id']);
        $mark = StudentMark::find($request->mark_id);
        $mark->update($data);
        return redirect(route('marks.view'));
    }

    public function getDelete($id)
    {
        StudentMark::where('id', $id)->delete();
        return response()->json('', 200);
    }

    public function postAjaxSearch(Request $request)
    {
        $marks = StudentMark::where('subject_title', 'like', '%'.$request->q.'%')->paginate(100);
        return response()->json(\Illuminate\Support\Facades\View::make('marks._table', [
            'marks' => $marks
        ])->render());
    }

    private function makeValidator($data)
    {
        $validator = Validator::make($data, [
            'student_id' => 'required',
            'subject_title' => 'required|string',
            'mark' => 'required|integer'
        ]);
        return $validator;
    }
}
