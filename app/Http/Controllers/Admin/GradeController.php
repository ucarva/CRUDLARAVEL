<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::with('subject','student')->orderBy('id','desc')->paginate(10);
        return view('admin.grades.index',compact('grades'));
    }

    public function create()
    {
        $students = Student::all();
        $subjects = Subject::all();

        return view('admin.grades.create', compact('students','subjects'));
    }

    public function store(Request $request, Grade $grade)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => [
                'required',
                'exists:subjects,id',
                Rule::unique('grades')->where(function ($query) use ($request) {
                    return $query->where('student_id', $request->student_id);
                }),
            ],
            'grade' => 'required|numeric|between:0,10',
            'observation' => 'required|string|max:255',
        ]);


        Grade::create($data);
        //variable de sesion de unico uso
        session()->flash('swal',[
            'icon' => 'success',
            'title'=> '!Calificacion creada',
            'text'=>'La calificacion se ha creado correctamente.'
        ]);

        return redirect()->route('admin.grades.index');
    }

    public function edit(Grade $grade)
    {
        $students = Student::all();
        $subjects = Subject::all();

        return view('admin.grades.edit', compact('grade','students','subjects'));

    }

    public function update(Request $request, Grade $grade)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => [
                'required',
                'exists:subjects,id',
                Rule::unique('grades')->ignore($grade->id)->where(function ($query) use ($request) {
                return $query->where('student_id', $request->student_id);
            }),

            ],
            'grade' => 'required|numeric|between:0,10',
            'observation' => 'required|string|max:255',
        ]);

        $grade->update($data);
        //variable de sesion de unico uso
        session()->flash('swal',[
            'icon' => 'success',
            'title'=> '!Calificacion actualizada',
            'text'=>'La calificacion se ha actualizado correctamente.'
        ]);

        return redirect()->route('admin.grades.index');
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();
        //variable de sesion de unico uso
        session()->flash('swal',[
            'icon' => 'success',
            'title'=> '!Calificacion eliminada',
            'text'=>'La calificacion se ha eliminado correctamente.'
        ]);

        return redirect()->route('admin.grades.index');
    }
}
