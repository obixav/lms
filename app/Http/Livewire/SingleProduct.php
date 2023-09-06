<?php

namespace App\Http\Livewire;

use App\Facades\Cart;
use Livewire\Component;

class SingleProduct extends Component
{
    public $product;
    public $quantity;
    /**
     * Mounts the component on the template.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->quantity = 1;
    }
    public function render()
    {
        return view('livewire.single-product');
    }
    public function addToCart(): void
    {
        $discount=$this->product->price-$this->product->discount_price;
        $image=$this->product->getFirstMedia("*")?$this->product->getFirstMedia("*")->original_url:asset('assets/images/shop/product1.jpg');

        Cart::add($this->product->id, $this->product->name, $this->product->discount_price, $this->quantity,['image'=>$image,'discount'=>$discount]);
        $this->emit('productAddedToCart');
    }
}
