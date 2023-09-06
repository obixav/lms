<?php

namespace App\Http\Livewire;
use App\Facades\Cart as CartFacade;
use Livewire\Component;
use Illuminate\Contracts\View\View;


class BigCart extends Component
{
    protected $total;
    protected $content;
    protected $total_disount;
    protected $listeners = [
        'productAddedToCart' => 'updateCart',
    ];
    /**
     * Mounts the component on the template.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->updateCart();
    }
    /**
     * Renders the component on the browser.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.big-cart', [
            'total' => $this->total,
            'content' => $this->content,
            'total_discount' => $this->total_discount,
        ]);
    }
    /**
     * Removes a cart item by id.
     *
     * @param string $id
     * @return void
     */
    public function removeFromCart(string $id): void
    {
        CartFacade::remove($id);
        $this->updateCart();
    }
    /**
     * Clears the cart content.
     *
     * @return void
     */
    public function clearCart(): void
    {
        CartFacade::clear();
        $this->updateCart();
    }
    /**
     * Updates a cart item.
     *
     * @param string $id
     * @param string $action
     * @return void
     */
    public function updateCartItem(string $id, string $action): void
    {
        CartFacade::update($id, $action);
        $this->updateCart();
    }
    /**
     * Rerenders the cart items and total price on the browser.
     *
     * @return void
     */
    public function updateCart()
    {
        $this->total = CartFacade::total();
        $this->content = CartFacade::content();
        $this->total_discount = CartFacade::total_discount();
        $this->company=company_info();
    }
}
