<?php

namespace App\Http\Livewire\Shop;

use App\Models\ShoppingCart;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Session\Session;

class Cart extends Component
{

    protected $listeners = ['itemAdd' => 'itemCRUD','itemDelete' => 'itemCRUD','itemChange' => 'itemCRUD'];

    // list , add
    public $type = "list";

    public $post;
    public $cart;

    public $total = "0";

    public function itemCRUD()
    {
        if(auth()->check())
            $this->total = ShoppingCart::where('user_id', auth()->id())->sum("count");
    }

    public function mount($post, $type = "list")
    {
        $this->post = $post;
        $this->type = $type;

        $session = new Session();
        $this->cart = $session->get('cart',[]);
    }

    public function render()
    {
        $this->itemCRUD();
        if ($this->type == "list")
            return view('livewire.shop.cart')->layout("layouts.web");
        return view('livewire.shop.cart-add')->layout("layouts.web");
    }
}
