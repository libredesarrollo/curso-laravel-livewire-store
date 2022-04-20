<?php

namespace App\Http\Livewire\Shop;

use Livewire\Component;
use Symfony\Component\HttpFoundation\Session\Session;

class CartItem extends Component
{

    public $count;
    public $post;

    protected $listeners = ['addItemToCart' => 'add'];

    public function add($post, $count = 1)
    {
        $session = new Session();
        $cart = $session->get('cart', []);
        $cart[$post["id"]] = [$post, $count];
        $session->set('cart', $cart);
        dd($session->get('cart', []));
    }

    public function render()
    {
        return view('livewire.shop.cart-item');
    }
}
