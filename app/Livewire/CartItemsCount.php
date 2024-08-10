<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class CartItemsCount extends Component
{
    public $items_count;

    public $bottom_navbar = false;

    public function mount()
    {
        $this->items_count = cart()->items_count();
    }

    #[On('cart-updated')]
    public function update_cart_items_count()
    {
        $this->items_count = cart()->items_count();
    }

    public function render()
    {
        return view('products.components.cart-items-count');
    }
}
