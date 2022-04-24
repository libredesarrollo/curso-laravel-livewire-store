<div>
    @livewire('shop.cart-item', ['postId' => $post->id])
    <button class="btn-primary" wire:click="$emit('addItemToCart',{{$post}})">Comprar</button>

    {{ $total }}
</div>
