<div>
    <form wire:submit.prevent="submit">
        <x-jet-label for="">Título</x-jet-label>
        <x-jet-input-error for="title" />

        <x-jet-input type="text" wire:model="title" />

        <x-jet-label for="">Texto</x-jet-label>

        <x-jet-input-error for="text" />

        <x-jet-input type="text" wire:model="text" />

        <x-jet-button type="submit">Enviar</x-jet-button>
    </form>
</div>