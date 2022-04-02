<div>

    <form wire:submit.prevent="submit">

        <x-jet-label>{{ __('Extra') }}</x-jet-label>
        <x-jet-input-error for="extra" />
        <textarea wire:model="extra"></textarea>

        <x-jet-button type="submit">Enviar</x-jet-button>
    </form>

</div>
