<?php

namespace App\Livewire;

use Livewire\Component;

class Wishlist extends Component
{
    public $wishlist_items;

    public function mount()
    {
        // Update wishlist items to remove old items that is deleted from the database
        wishlist()->update_items();

        $this->dispatch('wishlist-updated');

        $this->wishlist_items = wishlist()->items();
    }

    public function remove_item($index)
    {
        $wishlist = wishlist();

        $wishlist->remove($index);

        $this->wishlist_items = $wishlist->items();

        $this->dispatch('wishlist-updated');
    }

    public function update_quantity($index, $quantity)
    {
        $wishlist = wishlist();

        $wishlist->update_quantity($index, (int) $quantity);

        $this->wishlist_items = $wishlist->items();
    }

    public function render()
    {
        return view('products.wishlist');
    }
}
