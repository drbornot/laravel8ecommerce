<div>
    <a href="{{ route('products.wishlist') }}" class="link-direction">
        <i class="fa fa-heart" aria-hidden="true"></i>
        <div class="left-info">
            @if(Cart::instance('wishlist')->count())
                <span class="index">{{ Cart::instance('wishlist')->count() }} item</span>
            @endif
                <span class="title">Wishlist</span>
        </div>
    </a>
</div>
