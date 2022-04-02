<div>

    @if ($step == 1)
        <form wire:submit.prevent="submit">

            <x-jet-label>{{ __('Subject') }}</x-jet-label>
            <x-jet-input-error for="subject" />
            <x-jet-input type="text" wire:model="subject" />

            <x-jet-label>{{ __('Type') }}</x-jet-label>
            <x-jet-input-error for="type" />
            <select wire:model="type">
                <option value="">Seleccione</option>
                <option value="company">{{ __('Company') }}</option>
                <option value="person">{{ __('Person') }}</option>
            </select>

            <x-jet-label>{{ __('Message') }}</x-jet-label>
            <x-jet-input-error for="message" />
            <textarea wire:model="message"></textarea>

            <x-jet-button type="submit">Enviar</x-jet-button>
        </form>
    @elseif($step == 2)
        @livewire('contact.company')
    @elseif($step == 2.5)
        @livewire('contact.person')
    @elseif($step == 3)
        @livewire('contact.detail')
        {{-- @elseif($step == 4) --}}
    @else
        FIN
    @endif

</div>
