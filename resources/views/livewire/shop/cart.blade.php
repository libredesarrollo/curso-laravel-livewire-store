<div>
    <h3 class="text-center text-3xl mb-4">Carrito de compras</h3>
    @foreach ($cart as $c)
        @livewire('shop.cart-item', ['postId' => $c[0]['id']])
    @endforeach

    {{ view('livewire.shop.partials.shop-cart', ['total' => $total]) }}

</div>
