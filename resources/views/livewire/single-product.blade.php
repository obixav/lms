<div  class="add-to-cart pt-15">
    <input type="number" value="01" wire:model="quantity" min="1" max="20" onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;" required>
    <button wire:click="addToCart" class="theme-btn">Add to Cart</button>
    <button class="wishlist"><i class="far fa-heart"></i></button>
</div>
