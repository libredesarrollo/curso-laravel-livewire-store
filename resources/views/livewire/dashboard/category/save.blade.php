@slot('header')
    {{ __('CRUD categorias') }}
@endslot

<div class="container">

    <x-jet-action-message on="created">
        <div class="box-action-message">
            {{ __('Created category success') }}
        </div>
    </x-jet-action-message>

    <x-jet-action-message on="updated">
        <div class="box-action-message">
            {{ __('Updated category success') }}
        </div>
    </x-jet-action-message>

    <x-jet-form-section submit="submit">

        @slot('title')
            {{ __('Categories') }}
        @endslot

        @slot('description')
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate eaque, iure modi ipsa consequatur, veritatis
            debitis accusantium quasi consequuntur velit earum nam nisi dolores temporibus animi placeat, alias cumque
            assumenda.
        @endslot

        @slot('form')

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="">Título</x-jet-label>
                <x-jet-input-error for="title" />
                <x-jet-input class="block w-full" type="text" wire:model="title" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="">Texto</x-jet-label>
                <x-jet-input-error for="text" />
                <x-jet-input class="block w-full" type="text" wire:model="text" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="">Imagen</x-jet-label>
                <x-jet-input-error for="image" />
                <x-jet-input type="file" wire:model="image" />

                @if ($category && $category->image)
                    <img class="w-40 my-3" src="{{ $category->getImageUrl() }}" />
                @endif
            </div>

        @endslot

        @slot('actions')
            <x-jet-button type="submit">Enviar</x-jet-button>
        @endslot

    </x-jet-form-section>
</div>