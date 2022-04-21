<div>
    @if ($item)
        <div class="box mb-3">
            <p>
                <input wire:keydown.enter="update" class="w-20" type="number" wire:model="count">
                {{ $item[0]['title'] }}
                <button class="hidden" wire:click="update">Guardar</button>
            </p>
        </div>
    @endif
</div>
