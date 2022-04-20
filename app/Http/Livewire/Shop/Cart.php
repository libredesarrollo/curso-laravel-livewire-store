<?php

namespace App\Http\Livewire\Shop;

use App\Models\Post;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Session\Session;

class Cart extends Component
{

    // list , add
    public $type = "list";

    public $post;
    public $cart;

    // public function test()
    // {
    //     $this->emit("addItemToCart",Post::find(4));
    // }

    public function mount($post, $type = "list")
    {
        $this->post = $post;
        $this->type = $type;

        $session = new Session();
        $this->cart = $session->get('cart',[]);

        foreach ($this->cart as $key => $c) {
            //dd($c[0]['title']);
        }
        //dd($this->cart);
    }

    public function render()
    {
        if ($this->type == "list")
            return view('livewire.shop.cart')->layout("layouts.web");
        return view('livewire.shop.cart-add')->layout("layouts.web");
    }
}
