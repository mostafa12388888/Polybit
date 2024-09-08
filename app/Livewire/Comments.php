<?php

namespace App\Livewire;

use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class Comments extends Component
{
    public $url;
    
    public function placeholder()
    {
        return <<<'HTML'
            <div class="p-2 flex flex-col text-sm">
                <div class="flex items-center justify-between">
                    <div class="w-28 h-5 animated-background"></div>
                    <div class="w-36 h-5 animated-background"></div>
                </div>

                <hr class="!mt-8 !mb-6">
                
                <div class="flex gap-4">
                    <div class="shrink-0 w-12 h-12 animated-background"></div>
                    <div class="flex-grow h-12 animated-background"></div>
                </div>

                <hr class="!mt-8 !mb-6">

                <div class="flex gap-3 mb-6">
                    <div class="shrink-0 w-12 h-12 animated-background"></div>
                    <div class="flex-grow flex flex-col gap-2">
                        <div class="w-28 h-5 animated-background"></div>
                        <div class="flex-grow flex gap-1 flex-col">
                            <div class="flex-grow h-5 w-10/12 animated-background"></div>
                            <div class="flex-grow h-5 w-full animated-background"></div>
                            <div class="flex-grow h-5 w-8/12 animated-background"></div>
                        </div>
                    </div>
                </div>

                <div class="flex gap-3">
                    <div class="shrink-0 w-12 h-12 animated-background"></div>
                    <div class="flex-grow flex flex-col gap-2">
                        <div class="w-32 h-5 animated-background"></div>
                        <div class="flex-grow flex gap-1 flex-col">
                            <div class="flex-grow h-5 w-full animated-background"></div>
                            <div class="flex-grow h-5 w-9/12 animated-background"></div>
                            <div class="flex-grow h-5 w-11/12 animated-background"></div>
                        </div>
                    </div>
                </div>
            </div>
        HTML;
    }

    public function render()
    {
        return view('livewire.comments');
    }
}
