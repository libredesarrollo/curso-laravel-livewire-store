<div>

LISTADO


    @livewire('shop.cart-item')

    <button wire:click="test">Test</button>

     @foreach ($cart as $c)
        <div class="box mb-3">
            <p>
                <input class="w-20" type="number">
                {{ $c[0]['title'] }}
            </p>
        </div>
    @endforeach
</div>
