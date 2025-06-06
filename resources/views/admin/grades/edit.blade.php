<x-layouts.admin>
    <div class=" mb-4">
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">Dashboard</flux:breadcrumbs.item>
                <flux:breadcrumbs.item href="{{ route('admin.grades.index') }}" >Calificaciones</flux:breadcrumbs.item>
                <flux:breadcrumbs.item >Editar</flux:breadcrumbs.item>
            </flux:breadcrumbs>
            
    </div>  
    <div class="bg-white px-6 py-8 rounded-lg shadow-lg space-y-4 ">
        <form action="{{ route('admin.grades.update', $grade) }}" method="POST" class="p-5">
            @csrf
            @method('PUT')

        <flux:select label="Estudiante" name="student_id" placeholder="Seleccione el estudiante">
            @foreach ($students as $student)
                <option value="{{ $student->id }}" @selected(old('student_id', $grade->student_id) == $student->id)>
                    {{ $student->name }}
                </option>
            @endforeach
        </flux:select>

        <flux:select label="Materia" name="subject_id" placeholder="Seleccione la materia">
            @foreach ($subjects as $subject)
                <option value="{{ $subject->id }}" @selected(old('subject_id', $grade->subject_id) == $subject->id)>
                    {{ $subject->name }}
                </option>
            @endforeach
        </flux:select>
        <flux:input name="grade" type="decimal" label="Calificacion" value="{{ old('grade',$grade->grade) }}" />
        <flux:input name="observation" type="text" label="Observacion" value="{{ old('observation',$grade->observation) }}" />
        <div class="flex justify-end">
            <flux:button type="submit" variant="primary">Actualizar</flux:button>
        </div>



            
        </form>

    </div>

</x-layouts.admin>