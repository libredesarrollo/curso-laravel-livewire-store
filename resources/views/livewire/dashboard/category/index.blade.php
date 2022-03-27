@slot('header')
    {{ __('CRUD categorias') }}
@endslot


<x-card class="container">

    <x-jet-action-message on="deleted">
        {{ __('Category delete success') }}
    </x-jet-action-message>

    @slot('title')
        Listado
    @endslot

    <table class="table w-full border">
        <thead class="text-left bg-gray-100 ">
            <tr class="border-b">
                <th class="p-2">
                    Título
                </th>
                <th class="p-2">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $c)
                <tr class="border-b">
                    <td class="p-2">
                        {{ $c->title }}
                    </td>
                    <td class="p-2">
                        <a href="{{ route('d-category-edit', $c) }}" class="mr-2">Editar</a>
                        <x-jet-danger-button
                            onclick="confirm('Seguro que deseas eliminar el registro seleccionado?') || event.stopImmediatePropagation()"
                            wire:click="delete({{ $c }})">
                            Eliminar
                        </x-jet-danger-button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>

    {{ $categories->links() }}

</x-card>
