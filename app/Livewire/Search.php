<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{
    use WithPagination;

    public $query = '';

    public function mount()
    {
        $this->query = request()->query('q', '');
    }

    public function render()
    {
        if (strlen($this->query) > 250) {
            $this->addError('query', __('Search query can\'t be longer than :count words', ['count' => 250]));
        } else {
            $this->resetValidation('query');

            if ($query = trim($this->query)) {
                // search
            }
        }

        $this->js('document.querySelector(".search-results").scrollTo(0, 0)');

        return view('livewire.search', ['results' => $results ?? []]);
    }
}
