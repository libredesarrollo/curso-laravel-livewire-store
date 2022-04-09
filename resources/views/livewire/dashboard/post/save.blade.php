@slot('header')
    {{ __('CRUD posts') }}
@endslot

<div class="container">

    <x-jet-action-message on="created">
        <div class="box-action-message">
            {{ __('Created post success') }}
        </div>
    </x-jet-action-message>

    <x-jet-action-message on="updated">
        <div class="box-action-message">
            {{ __('Updated post success') }}
        </div>
    </x-jet-action-message>

    <x-jet-form-section submit="submit">

        @slot('title')
            {{ __('Posts') }}
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
                <x-jet-label for="">Fecha</x-jet-label>
                <x-jet-input-error for="date" />
                <x-jet-input class="block w-full" type="date" wire:model="date" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="">Contenido</x-jet-label>
                <x-jet-input-error for="text" />

                <textarea class="block w-full" wire:model="text"></textarea>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="">Descripción</x-jet-label>
                <x-jet-input-error for="description" />

                <textarea class="block w-full" wire:model="description"></textarea>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="">Posted</x-jet-label>
                <x-jet-input-error for="posted" />

                <select class="block w-full" wire:model="posted">
                    <option value=""></option>
                    <option value="not">No</option>
                    <option value="yes">Si</option>
                </select>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="">Típo</x-jet-label>
                <x-jet-input-error for="type" />

                <select class="block w-full" wire:model="type">
                    <option value=""></option>
                    <option value="adverd">adverd</option>
                    <option value="post">post</option>
                    <option value="course">course</option>
                    <option value="movie">movie</option>
                </select>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="">Categorías</x-jet-label>
                <x-jet-input-error for="category_id" />

                <select class="block w-full" wire:model="category_id">
                    <option value=""></option>
                    @foreach ($categories as $c)
                     <option value="{{$c->id}}">{{$c->title}}</option>
                    @endforeach
                </select>
            </div>

      
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="">Imagen</x-jet-label>
                <x-jet-input-error for="image" />
                <x-jet-input type="file" wire:model="image" />

                @if ($post && $post->image)
                    <img class="w-40 my-3" src="{{ $post->getImageUrl() }}" />
                @endif
            </div>

        @endslot

        @slot('actions')
            <x-jet-button type="submit">Enviar</x-jet-button>
        @endslot

    </x-jet-form-section>
</div>