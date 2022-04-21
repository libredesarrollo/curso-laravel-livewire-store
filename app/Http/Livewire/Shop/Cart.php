<?php

namespace App\Http\Livewire\Shop;

use Livewire\Component;
use Symfony\Component\HttpFoundation\Session\Session;

class Cart extends Component
{

    // list , add
    public $type = "list";

    public $post;
    public $cart;

    public function mount($post, $type = "list")
    {
        $this->post = $post;
        $this->type = $type;

        $session = new Session();
        $this->cart = $session->get('cart',[]);
    }

    public function render()
    {
        if ($this->type == "list")
            return view('livewire.shop.cart')->layout("layouts.web");
        return view('livewire.shop.cart-add')->layout("layouts.web");
    }
}
