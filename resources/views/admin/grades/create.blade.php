<x-layouts.admin>
    <div class=" mb-4">
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">Dashboard</flux:breadcrumbs.item>
                <flux:breadcrumbs.item href="{{ route('admin.grades.index') }}" >Calificaciones</flux:breadcrumbs.item>
                <flux:breadcrumbs.item >Nuevo</flux:breadcrumbs.item>
            </flux:breadcrumbs>
            
    </div>  
    <div class="bg-white px-6 py-8 rounded-lg shadow-lg space-y-4 ">
        <form action="{{ route('admin.grades.store') }}" method="POST" class="p-5">
            @csrf
            <flux:select label="Estudiante" name="student_id" placeholder="Seleccione un estudiante">
                    @foreach ( $students as $student )
                    <flux:select.option value="{{ $student->id }}">{{ $student->name }}</flux:select.option>
                    @endforeach
            </flux:select>
            <flux:select label="Materia" name="subject_id" placeholder="Seleccione una materia"  >
                    @foreach ( $subjects as $subject )
                    <flux:select.option value="{{ $subject->id }}">{{ $subject->name }}</flux:select.option>
                    @endforeach   
            </flux:select>
            <flux:input name="grade" type="decimal" label="Calificacion" value="{{ old('grade') }}" />
            <flux:input name="observation" type="text" label="Observacion" value="{{ old('observation') }}" />
             
            
            <div class="flex justify-end">
                <flux:button type="submit" variant="primary">Crear</flux:button>
            </div>
            
        </form>

    </div>

</x-layouts.admin>