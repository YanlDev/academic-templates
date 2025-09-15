<?php

namespace App\Livewire\Public;

use Livewire\Component;
use App\Models\TemplateCategory;

class Navigation extends Component
{
    public $cartCount = 0;
    public $showMobileMenu = false;

    protected $listeners = ['cartUpdated' => 'updateCartCount'];

    public function mount()
    {
        $this->updateCartCount();
    }

    public function updateCartCount()
    {
        // Aquí calcularás el count del carrito
        $this->cartCount = session('cart_count', 0);
    }

    public function toggleMobileMenu()
    {
        $this->showMobileMenu = !$this->showMobileMenu;
    }

    public function render()
    {
        return view('livewire.public.navigation', [
            'categories' => TemplateCategory::where('active', true)
                ->orderBy('sort_order')
                ->take(6)
                ->get()
        ]);
    }
}
