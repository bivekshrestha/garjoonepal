@auth

    <form
    action="{{ route('review.store') }}"
    method="POST"
>
    @csrf

    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
    <input type="hidden" name="product_id" value="{{ $product->id }}">

    <div class="row">
        <div class="col-12 mb-3">
            <div class="form-floating">
                <input
                    type="text"
                    id="message"
                    name="message"
                    class="form-control"
                    placeholder="Write Your Review"
                >
                <label for="message">Review</label>
            </div>
        </div>

        <div class="col-12 mb-3">
            <div class="wrap">
                <div class="stars">
                    <label class="rate">
                        <input type="radio" name="rating" id="star1" value="1">
                        <div class="face"></div>
                        <i class="far fa-star star one-star"></i>
                    </label>
                    <label class="rate">
                        <input type="radio" name="rating" id="star2" value="2">
                        <div class="face"></div>
                        <i class="far fa-star star two-star"></i>
                    </label>
                    <label class="rate">
                        <input type="radio" name="rating" id="star3" value="3">
                        <div class="face"></div>
                        <i class="far fa-star star three-star"></i>
                    </label>
                    <label class="rate">
                        <input type="radio" name="rating" id="star4" value="4">
                        <div class="face"></div>
                        <i class="far fa-star star four-star"></i>
                    </label>
                    <label class="rate">
                        <input type="radio" name="rating" id="star5" value="5">
                        <div class="face"></div>
                        <i class="far fa-star star five-star"></i>
                    </label>
                </div>
            </div>
        </div>


    </div>

    <button class="btn btn-primary">Submit</button>

</form>

@else
    <a href="{{ route('login') }}" class="btn btn-primary">Write Review</a>
@endauth
