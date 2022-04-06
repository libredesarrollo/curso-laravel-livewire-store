<form wire:submit.prevent="submit" class="flex flex-col max-w-sm mx-auto">

    <x-jet-label>{{ __('Extra') }}</x-jet-label>
    <x-jet-input-error for="extra" />
    <textarea wire:model="extra"></textarea>

    <div class="flex mt-5 gap-3">
        <x-jet-secondary-button wire:click="$emit('stepEvent',2)">Atrás</x-jet-secondary-button>
        <x-jet-button type="submit">Enviar</x-jet-button>
    </div>
</form>
