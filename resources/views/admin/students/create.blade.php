<x-layouts.admin>
    <div class=" mb-4">
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">Dashboard</flux:breadcrumbs.item>
                <flux:breadcrumbs.item href="{{ route('admin.students.index') }}" >Estudiantes</flux:breadcrumbs.item>
                <flux:breadcrumbs.item >Nuevo</flux:breadcrumbs.item>
            </flux:breadcrumbs>
            
    </div>  
    <div class="bg-white px-6 py-8 rounded-lg shadow-lg space-y-4 ">
        <form action="{{ route('admin.students.store') }}" method="POST" class="p-5">
            @csrf
            <flux:input name="name" type="text" label="Nombre" value="{{ old('name') }}" />
            <flux:input name="email" type="email" label="Email" />
            <flux:input name="birth_date" type="date" max="2999-12-31" label="Fecha nacimiento" />
            <div class="flex justify-end">
                <flux:button type="submit" variant="primary">Crear</flux:button>
            </div>
            
        </form>

    </div>

</x-layouts.admin>