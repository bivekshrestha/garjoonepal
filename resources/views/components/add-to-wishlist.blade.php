@auth
    @if(!$wishlistId)
        <form
            method="POST"
            action="{{ route('wishlist.store') }}"
        >
            @csrf

            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="product_id" value="{{ $productId }}">

            <button type="submit" class="btn icon_wishlist">
                <i class="far fa-heart"></i>
            </button>

        </form>
    @else
        <form
            method="POST"
            action="{{ route('wishlist.delete') }}"
        >
            @csrf
            @method('DELETE')

            <input type="hidden" name="wishlist_id" value="{{ $wishlistId }}">

            <button type="submit" class="icon_wishlist btn">
                <i class="fa fa-heart "></i>
            </button>

        </form>
    @endif
@else
    <a class="icon_wishlist" href="{{ route('login') }}">
        <i class="far fa-heart"></i>
    </a>
@endauth
