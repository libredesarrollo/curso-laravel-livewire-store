<div>
    @livewire('shop.cart-item')
    <button wire:click="$emit('addItemToCart',{{$post}})">Comprar</button>
</div>
