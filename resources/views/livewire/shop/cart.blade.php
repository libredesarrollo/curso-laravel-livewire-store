<div>
    @foreach (session('cart') as $c)
        <div class="box mb-3">
            <p>
                <input class="w-20" type="number">
                {{ $c->title }}
            </p>
        </div>
    @endforeach
</div>
