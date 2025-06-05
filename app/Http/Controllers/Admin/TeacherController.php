<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::orderBy('id','desc')->paginate(10);

        return view('admin.teachers.index',compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([

            'name'=>'required|string|max:255|unique:teachers',
            'email'=>'required|string|max:255|unique:teachers',
            
        ]);

        //creando al profesor
        Teacher::create($data);

        //variable de sesion de unico uso
        session()->flash('swal',[
            'icon' => 'success',
            'title'=> '!Profesor creado',
            'text'=>'El profesor se ha creado correctamente.'
        ]);

        return redirect()->route('admin.teachers.index');
    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit',compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
         $data = $request->validate([
                'name' => 'required|string|max:255|unique:teachers,name,' . $teacher->id,
                'email' => 'required|string|max:255|unique:teachers,email,' . $teacher->id,
               


        ]);

        $teacher->update($data);

        //variable de sesion de unico uso
        session()->flash('swal',[
            'icon' => 'success',
            'title'=> '!Profesor actualizado',
            'text'=>'El profesor se ha actualizado correctamente.'
        ]);

        return redirect()->route('admin.teachers.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
         $teacher->delete();

        //variable de sesion de unico uso
        session()->flash('swal',[
            'icon' => 'success',
            'title'=> '!Profesor eliminado',
            'text'=>'El profesor se ha eliminado correctamente.'
        ]);

        return redirect()->route('admin.teachers.index');
    }
}
