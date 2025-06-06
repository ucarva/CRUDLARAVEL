<x-layouts.admin>
    <div class=" mb-4">
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">Dashboard</flux:breadcrumbs.item>
                 <flux:breadcrumbs.item href="{{ route('admin.subjects.index') }}" >Materias</flux:breadcrumbs.item>
                <flux:breadcrumbs.item >Nuevo</flux:breadcrumbs.item>
            </flux:breadcrumbs>
            
    </div>  
    <div class="bg-white px-6 py-8 rounded-lg shadow-lg space-y-4 ">
        <form action="{{ route('admin.subjects.store') }}" method="POST" class="p-5">
            @csrf
            <flux:input name="name" type="text" label="Nombre" value="{{ old('name') }}" />
            <flux:input name="description" type="text" label="Descripcion" value="{{ old('description') }}" />
            <flux:select label="Profesor" name="teacher_id" placeholder="Seleccione el profesor"  >
            @foreach ( $teachers as $teacher )
            <flux:select.option value="{{ $teacher->id }}">{{ $teacher->name }}</flux:select.option>
            @endforeach
            
        </flux:select>
             
            <div class="flex justify-end">
                <flux:button type="submit" variant="primary">Crear</flux:button>
            </div>
            
        </form>

    </div>

</x-layouts.admin>