<?php

namespace App\Http\Livewire\Shop;

use App\Models\Post;
use Livewire\Component;

class Cart extends Component
{

    private function initSessionCart()
    {
        if (!session()->has('cart')) {

            $post1 = Post::find(1);
            $post2 = Post::find(4);
            $post3 = Post::find(5);

            session(['cart' => [$post1, $post2, $post3]]);
            dd(session('cart'));
        }
    }

    public function mount()
    {
        $this->initSessionCart();
    }

    public function render()
    {
        return view('livewire.shop.cart')->layout("layouts.web");
    }
}
