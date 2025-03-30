<?php

namespace App\Livewire;

use App\Models\Catalog;
use Illuminate\Support\Facades\Cookie;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;

class RequestCatalog extends Component
{
    public Catalog $catalog;

    #[Validate('max:100')]
    public $name;

    #[Validate('required_without:phone|email')]
    public $email;

    #[Validate('max:50')]
    public $phone;

    #[Validate('max:150')]
    public $company;

    #[Validate('max:5000')]
    public $message;

    #[Locked]
    public $request_submitted;

    public function mount(Catalog $catalog)
    {
        $this->catalog = $catalog;

        $this->set_guest_data();
    }

    public function request_catalog()
    {
        $this->validate();

        $this->update_guest_data();

        $this->catalog->requests()->create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company' => $this->company,
            'message' => $this->message,
        ]);

        $this->request_submitted = true;
    }

    public function update_guest_data()
    {
        Cookie::queue('guest', json_encode([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company' => $this->company,
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
            $this->company = $this->phone ?: optional($guest)['company'];
        }
    }

    public function render()
    {
        return view('livewire.request-catalog');
    }
}
