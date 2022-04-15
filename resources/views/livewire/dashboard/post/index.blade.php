@slot('header')
    {{ __('CRUD categorias') }}
@endslot
<x-card class="container">

    <x-jet-action-message on="deleted">
        <div class="box-action-message">
            {{ __('Post deleted success') }}
        </div>
    </x-jet-action-message>

    @slot('title')
        Listado
    @endslot



    <a class="btn-secondary mb-3" href="{{ route('d-post-create') }}">Crear</a>

    <div class="grid grid-cols-2 mb-2 gap-2">
        <x-jet-input class="w-full" type="text" wire:model="search"
            placeholder="Buscar por id, tìtulo o descripción"></x-jet-input>
        <div class="grid grid-cols-2 gap-2">
            <x-jet-input class="w-full" type="date" wire:model="from" placeholder="Desde"></x-jet-input>
            <x-jet-input class="w-full" type="date" wire:model="to" placeholder="Hasta"></x-jet-input>
        </div>
    </div>

    <div class="flex gap-2 mb-2">

        <select class="block w-full" wire:model="posted">
            <option value="">{{ __('Posted') }}</option>
            <option value="not">No</option>
            <option value="yes">Si</option>
        </select>

        <select class="block w-full" wire:model="type">
            <option value="">{{ __('Type') }}</option>
            <option value="adverd">adverd</option>
            <option value="post">post</option>
            <option value="course">course</option>
            <option value="movie">movie</option>
        </select>

        <select class="block w-full" wire:model="category_id">
            <option value="">{{ __('Category') }}</option>
            @foreach ($categories as $i => $c)
                <option value="{{ $i }}">{{ $c }}</option>
            @endforeach
        </select>

    </div>

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
            @foreach ($posts as $p)
                <tr class="border-b">
                    <td class="p-2">
                        {{ $p->id }}
                    </td>
                    <td class="p-2">
                        {{ str($p->title)->substr(0, 15) }}
                    </td>
                    <td class="p-2">
                        {{ $p->date }}
                    </td>
                    <td class="p-2">
                        <textarea class="w-48">
                        {{ $p->description }}
                       </textarea>
                    </td>
                    <td class="p-2">
                        {{ $p->posted }}
                    </td>
                    <td class="p-2">
                        {{ $p->type }}
                    </td>
                    <td class="p-2">
                        {{ $p->category->title }}
                    </td>
                    <td class="p-2">
                        <x-jet-nav-link href="{{ route('d-post-edit', $p) }}" class="mr-2">Editar
                        </x-jet-nav-link>
                        <x-jet-danger-button {{-- onclick="confirm('Seguro que deseas eliminar el registro seleccionado?') || event.stopImmediatePropagation()" --}}
                            wire:click="seletedPostToDelete({{ $p }})">
                            Eliminar
                        </x-jet-danger-button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>

    {{ $posts->links() }}

    <x-jet-confirmation-modal wire:model="confirmingDeletePost">
        <x-slot name="title">
            {{ __('Delete Post') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this post?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingDeletePost')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="delete()" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</x-card>

<script>
    window.onload = function(){
        Livewire.hook("element.updated",(el,component)=>{
           // console.log(component)
        })
        Livewire.hook("element.updating",(fromEl,toEl,component)=>{
            //console.log(fromEl)
        })
        Livewire.hook("element.removed",(el,component)=>{
            console.log(el)
        })
        Livewire.hook("message.sent",(message,component)=>{
         //   console.log(message)
          //  console.log(message.updateQueue[0].payload.method)
        })
    }
</script>
