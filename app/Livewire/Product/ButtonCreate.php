<?php

namespace App\Livewire\Product;

use Livewire\Component;

class ButtonCreate extends Component
{
    public function toggleModal()
    {
        $this->dispatch('toggle-modal')->to(Main::class);
    }

    public function render()
    {
        return view('livewire.product.button-create');
    }
}
