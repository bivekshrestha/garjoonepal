<form
    method="POST"
    action="{{ route('wishlist.move') }}"
>
    @csrf
    <input type="hidden" name="wishlist_id" value="{{ $wishlistId }}">

    <button type="submit" class="btn btn-app-primary text-white">
        {{ __('cart.btn.move') }}
    </button>

</form>
