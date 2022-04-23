<?php

namespace App\Listeners;

use App\Models\ShoppingCart;
use Illuminate\Auth\Events\Login as IlluminateAuthEventsLogin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Session\Session;

class LoginSuccessful
{
    /**
     * Create the event listener.
     *
     * @return void
     */

     public $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function add($post, $count = 1)
    {

        $cart = $this->session->get('cart',[]);

        // eliminar
        if ($count <= 0) {
            if (Arr::exists($cart, $post['id'])) {
                unset($cart[$post['id']]);
                unset($this->item);
                $this->session->set('cart', $cart);
            }
            return;
        }

        // agregar
        if (Arr::exists($cart, $post['id'])) {
            $cart[$post['id']][1] = $count;
        } else {
            $cart[$post["id"]] = [$post, $count];
        }

        $this->item = $cart[$post['id']];
        $this->count = $this->item[1];
        $this->session->set('cart', $cart);
    }

    /**
     * Handle the event.
     *
     * @param  \IlluminateAuthEventsLogin  $event
     * @return void
     */
    public function handle(IlluminateAuthEventsLogin $event)
    {
        $carts = ShoppingCart::where('user_id', auth()->id())->get();


        $this->session->set('cart',[]);

        foreach ($carts as $c) {
            $this->add($c->post,$c->count);
        }
    }
}
