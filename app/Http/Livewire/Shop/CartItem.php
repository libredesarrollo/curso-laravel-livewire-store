<?php

namespace App\Http\Livewire\Shop;

use App\Models\ShoppingCart;
use Illuminate\Support\Arr;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Session\Session;

class CartItem extends Component
{

    // gestion
    public $count;

    // ini
    public $item;

    protected $listeners = ['addItemToCart' => 'add'];

    public function mount($postId)
    {
        $session = new Session();
        $cart = $session->get('cart', []);

        if (Arr::exists($cart, $postId)) {
            $this->item = $cart[$postId]; // post , cantidades
            $this->count = $this->item[1];
        }
    }

    public function add($post, $count = 1)
    {
        $session = new Session();
        $cart = $session->get('cart', []);

        // eliminar
        if ($count <= 0) {
            if (Arr::exists($cart, $post['id'])) {
                unset($cart[$post['id']]);
                unset($this->item);
                $session->set('cart', $cart);
                $this->saveDB($cart);
                $this->emit("itemDelete");
            }
            return;
        }

        // agregar
        if (Arr::exists($cart, $post['id'])) {
            $cart[$post['id']][1] = $count;
            $this->emit("itemChange",$post);
        } else {
            $cart[$post["id"]] = [$post, $count];
            $this->emit("itemAdd",$post);
        }

        $this->item = $cart[$post['id']];
        $this->count = $this->item[1];
        $session->set('cart', $cart);
        $this->saveDB($cart);
        //dd($session->get('cart', []));
    }

    private function saveDB($cart)
    {
        // *** agregamos, cambiamos

        if (auth()->check()) {

            $control = time();

            foreach ($cart as $c) {
                ShoppingCart::updateOrCreate(
                    [
                        'post_id' => $c[0]['id'],
                        'user_id' => auth()->id(),    
                    ],
                    [
                        'post_id' => $c[0]['id'],
                        'count' => $c[1],
                        'user_id' => auth()->id(),
                        'control' => $control
                    ]
                );
            }
             // *** borrar
            ShoppingCart::whereNot('control', $control)->where('user_id',auth()->id())->delete();
        }

       
    }

    public function update()
    {
        $this->add($this->item[0], $this->count);
    }

    public function render()
    {
        return view('livewire.shop.cart-item');
    }
}
