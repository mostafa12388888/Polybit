<?php

namespace App\Livewire;

use Livewire\Component;

class CartItems extends Component
{
    public $cart_items;

    public function mount()
    {
        $this->cart_items = cart()->items();
    }

    public function remove_item($index)
    {
        $cart = cart();

        $cart->remove($index);

        $this->cart_items = $cart->items();

        $this->dispatch('cart-updated');
    }

    public function update_quantity($index, $quantity)
    {
        $cart = cart();

        $cart->update_quantity($index, (int) $quantity);

        $this->cart_items = $cart->items();
    }

    public function render()
    {
        return view('products.components.cart-items');
    }
}
