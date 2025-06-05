<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::with('teacher')->orderBy('id','desc')->paginate(10);
        return view('admin.subjects.index', compact('subjects'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::all();
        return view('admin.subjects.create',compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Subject $subject)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:subjects,name,' . $subject->id,
            'description' => 'required|string|max:255|unique:subjects,description,' . $subject->id,
            'teacher_id' => 'required | exists:teachers,id',
        ]);

        Subject::create($data);
        //variable de sesion de unico uso
        session()->flash('swal',[
            'icon' => 'success',
            'title'=> '!Materia creada',
            'text'=>'La materia se ha creado correctamente.'
        ]);

        return redirect()->route('admin.subjects.index');

    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        $teachers = Teacher::all();
        return view('admin.subjects.edit',compact('subject','teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        

         $data = $request->validate([
            'name' => 'required|string|max:255|unique:subjects,name,' . $subject->id,
            'description' => 'required|string|max:255|unique:subjects,description,' . $subject->id,
            'teacher_id' => 'required | exists:teachers,id',
        ]);

        $subject->update($data);
        //variable de sesion de unico uso
        session()->flash('swal',[
            'icon' => 'success',
            'title'=> '!Materia actualizada',
            'text'=>'La materia se ha actualizado correctamente.'
        ]);

        return redirect()->route('admin.subjects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        //variable de sesion de unico uso
        session()->flash('swal',[
            'icon' => 'success',
            'title'=> '!Materia eliminada',
            'text'=>'La materia se ha eliminado correctamente.'
        ]);

        return redirect()->route('admin.subjects.index');


    }
}
