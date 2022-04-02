<div>

    <form wire:submit.prevent="submit">

        <x-jet-label>{{ __('Name') }}</x-jet-label>
        <x-jet-input-error for="name" />
        <x-jet-input type="text" wire:model="name" />

        <x-jet-label>{{ __('Identification') }}</x-jet-label>
        <x-jet-input-error for="identification" />
        <x-jet-input type="text" wire:model="identification" />

        <x-jet-label>{{ __('Email') }}</x-jet-label>
        <x-jet-input-error for="email" />
        <x-jet-input type="email" wire:model="email" />
        
        <x-jet-label>{{ __('Extra') }}</x-jet-label>
        <x-jet-input-error for="extra" />
        <x-jet-input type="text" wire:model="extra" />

        <x-jet-label>{{ __('Choices') }}</x-jet-label>
        <x-jet-input-error for="choices" />
        <select wire:model="choices">
            <option value="">Seleccione</option>
            <option value="adverd">{{__('Adverd')}}</option>
            <option value="post">{{__('Post')}}</option>
            <option value="course">{{__('Course')}}</option>
            <option value="movie">{{__('Movie')}}</option>
            <option value="other">{{__('Other')}}</option>
        </select>

        <x-jet-button type="submit">Enviar</x-jet-button>
    </form>

</div>
