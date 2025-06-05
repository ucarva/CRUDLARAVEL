<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $students = Student::orderBy('id','desc')->paginate(10);

        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('admin.students.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Agregando validaciones

       $data = $request->validate([

            'name'=>'required|string|max:255|unique:students',
            'email'=>'required|string|max:255|unique:students',
            'birth_date' => 'required|date|before:today|after:1900-01-01',


        ]);

        //creando el estudiante
        Student::create($data);

        //variable de sesion de unico uso
        session()->flash('swal',[
            'icon' => 'success',
            'title'=> '!Estudiante creado',
            'text'=>'El estudiante se ha creado correctamente.'
        ]);

        return redirect()->route('admin.students.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('admin.students.edit',compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
                'name' => 'required|string|max:255|unique:students,name,' . $student->id,
                'email' => 'required|string|max:255|unique:students,email,' . $student->id,
                'birth_date' => 'required|date|before:today|after:1900-01-01',


        ]);

        $student->update($data);

        //variable de sesion de unico uso
        session()->flash('swal',[
            'icon' => 'success',
            'title'=> '!Estudiante actualizado',
            'text'=>'El estudiante se ha actualizado correctamente.'
        ]);

        return redirect()->route('admin.students.index');
        
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        //variable de sesion de unico uso
        session()->flash('swal',[
            'icon' => 'success',
            'title'=> '!Estudiante eliminado',
            'text'=>'El estudiante se ha eliminado correctamente.'
        ]);

        return redirect()->route('admin.students.index');
    }
}
