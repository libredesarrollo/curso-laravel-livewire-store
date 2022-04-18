<div>

    <x-card>
        <div class="grid grid-cols-2 mb-2 gap-2">
            <x-jet-input class="w-full" type="text" wire:model.debounce.500ms="search"
                placeholder="Buscar por id, tìtulo o descripción"></x-jet-input>
            <div class="grid grid-cols-2 gap-2">
                <x-jet-input class="w-full" type="date" wire:model="from" placeholder="Desde"></x-jet-input>
                <x-jet-input class="w-full" type="date" wire:model="to" placeholder="Hasta"></x-jet-input>
            </div>
        </div>

        <div class="flex gap-2 mb-2">

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
    </x-card>

    <div class="flex flex-col items-center mt-5">
        <div class="w-full sm:max-w-4xl overflow-hidden">
            @foreach ($posts as $p)
                <h4 class="text-center text-4xl mb-3">{{ $p->title }}</h4>
                <p class="text-center text-sm text-gray-500 italic font-bold uppercase tracking-widest">
                    {{ $p->date->format('d-m-Y') }}</p>

                <img class="w-full rounded-md my-3" src="{{ $p->getImageUrl() }}">

                <p class="mx-4">{{ $p->description }}</p>

                <hr class="my-24">
            @endforeach
        </div>
    </div>
    {{ $posts->links() }}

</div>
