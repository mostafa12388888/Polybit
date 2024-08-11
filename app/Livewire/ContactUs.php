<?php

namespace App\Livewire;

use App\Models\Message;
use Illuminate\Support\Facades\Cookie;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ContactUs extends Component
{
    #[Validate('max:100')]
    public $name;

    #[Validate('required_without:phone|email')]
    public $email;

    #[Validate('max:50')]
    public $phone;

    #[Validate('max:5000')]
    public $message;

    public $message_sent;

    public function mount()
    {
        $this->set_guest_data();
    }

    public function send_message()
    {
        $this->validate();

        $this->update_guest_data();

        Message::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message,
        ]);

        $this->message_sent = true;
    }

    public function update_guest_data()
    {
        Cookie::queue('guest', json_encode([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]), 36 * 30 * 24 * 60);
    }

    public function set_guest_data()
    {
        $guest = request()->cookie('guest');

        $guest = json_decode($guest ?? '', true);

        if (is_array($guest)) {
            $this->name = optional($guest)['name'];
            $this->email = optional($guest)['email'];
            $this->phone = optional($guest)['phone'];
        }
    }

    public function render()
    {
        return view('pages.contact-us');
    }
}
