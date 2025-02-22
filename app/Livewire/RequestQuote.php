<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Cookie;
use Livewire\Attributes\Validate;
use Livewire\Component;

class RequestQuote extends Component
{
    public $cart_items;

    #[Validate('max:100')]
    public $name;

    #[Validate('required_without:phone|email')]
    public $email;

    #[Validate('max:50')]
    public $phone;

    #[Validate('max:5000')]
    public $message;

    public $order_created;

    public function mount()
    {
        $this->cart_items = cart()->items;

        if (auth()->user()) {
            $this->set_user_data();
        }

        $this->set_guest_data();

        if (! count($this->cart_items)) {
            return $this->redirect(route('cart'));
        }
    }

    public function request_quote()
    {
        $this->validate();

        $this->update_guest_data();

        $order = Order::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message,
        ]);

        foreach (cart($this->cart_items)->items() as $product) {
            $order->items()->create([
                'product_id' => $product->id,
                'variant_id' => optional($product->variant)->id,
                'quantity' => $product->quantity,
            ]);
        }

        cart()->clear();

        $this->dispatch('cart-updated');

        $this->order_created = true;
    }

    public function update_guest_data()
    {
        Cookie::queue('guest', json_encode([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]), 36 * 30 * 24 * 60);
    }

    public function set_user_data()
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->phone = auth()->user()->phone;
    }

    public function set_guest_data()
    {
        $guest = request()->cookie('guest');

        $guest = json_decode($guest ?? '', true);

        if (is_array($guest)) {
            $this->name = $this->name ?: optional($guest)['name'];
            $this->email = $this->email ?: optional($guest)['email'];
            $this->phone = $this->phone ?: optional($guest)['phone'];
        }
    }

    public function render()
    {
        return view('products.components.request-quote');
    }
}
