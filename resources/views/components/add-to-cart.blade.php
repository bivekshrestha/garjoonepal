@auth
    @if(!$cartId)
        <form
            method="POST"
            action="{{ route('cart.store') }}"
        >
            @csrf

            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="product_id" value="{{ $productId }}">

            <button type="submit" class="btn_cart">
                <span>{{ __('cart.btn.add') }}</span>
            </button>

        </form>
    @else
        <form
            method="POST"
            action="{{ route('cart.delete') }}"
        >
            @csrf
            @method('DELETE')

            <input type="hidden" name="cart_id" value="{{ $cartId }}">

            <button type="submit" class="btn_cart">
                <span>{{ __('cart.btn.remove') }}</span>
            </button>

        </form>
    @endif
@else
    <a class="btn_cart" href="{{ route('') }}">
        <span>{{ __('cart.btn.add') }}</span>
    </a>
@endauth
