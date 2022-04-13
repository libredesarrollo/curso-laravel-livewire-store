@slot('header')
    {{ __('CRUD categorias') }}
@endslot
<x-card class="container">

    <x-jet-action-message on="deleted">
        <div class="box-action-message">
            {{ __('Category deleted success') }}
        </div>
    </x-jet-action-message>

    @slot('title')
        Listado
    @endslot

    <a class="btn-secondary mb-3" href="{{ route('d-category-create') }}">Crear</a>

    <table class="table w-full border">
        <thead class="text-left bg-gray-100 ">
            <tr class="border-b">
                @foreach ($columns as $key => $c)
                    <th>
                        <button wire:click="sort('{{ $key }}')">
                            {{ $c }}
                            @if ($key == $sortColumn)
                                @if ($sortDirection == 'asc')
                                    &uarr;
                                @else
                                    &darr;
                                @endif
                            @endif
                            
                        </button>
                    </th>
                @endforeach
                <th class="p-2">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $c)
                <tr class="border-b">
                    <td class="p-2">
                        {{ $c->id }}
                    </td>
                    <td class="p-2">
                        {{ $c->title }}
                    </td>
                    <td class="p-2">
                        <x-jet-nav-link href="{{ route('d-category-edit', $c) }}" class="mr-2">Editar</x-jet-nav-link>
                        <x-jet-danger-button {{-- onclick="confirm('Seguro que deseas eliminar el registro seleccionado?') || event.stopImmediatePropagation()" --}}
                            wire:click="seletedCategoryToDelete({{ $c }})">
                            Eliminar
                        </x-jet-danger-button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>

    {{ $categories->links() }}

    <x-jet-confirmation-modal wire:model="confirmingDeleteCategory">
        <x-slot name="title">
            {{ __('Delete Category') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this category?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingDeleteCategory')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="delete()"
                wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>

</x-card>
