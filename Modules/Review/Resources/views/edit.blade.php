@if(auth()->id() == $review->user_id)
    <form
        action="{{ route('review.update') }}"
        method="POST"
    >
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $review->id }}">

        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
        <input type="hidden" name="product_id" value="{{ $product->id }}">

        <div class="row">
            <div class="col-12 mb-3">
                <div class="form-floating">
                    <input
                        type="text"
                        id="message-edit"
                        name="message"
                        class="form-control"
                        placeholder="Write Your Review"
                        value="{{ $review->message }}"
                    >
                    <label for="message">Review</label>
                </div>
            </div>

            <div class="col-12 mb-3">
                <div class="wrap">
                    <div class="stars">
                        <label class="rate">
                            <input type="radio" name="rating" id="star1-edit" value="1"
                                   @if ($review->rating == 1) checked @endif>
                            <div class="face"></div>
                            <i class="far fa-star star one-star @if (1 <= $review->rating) fas @endif @if($review->rating == 1) rate-active @endif"></i>
                        </label>
                        <label class="rate">
                            <input type="radio" name="rating" id="star2-edit" value="2"
                                   @if ($review->rating == 2) checked @endif>
                            <div class="face"></div>
                            <i class="far fa-star star two-star @if (2 <= $review->rating) fas @endif @if($review->rating == 2) rate-active @endif"></i>
                        </label>
                        <label class="rate">
                            <input type="radio" name="rating" id="star3-edit" value="3"
                                   @if ($review->rating == 3) checked @endif>
                            <div class="face"></div>
                            <i class="far fa-star star three-star @if (3 <= $review->rating) fas @endif @if($review->rating == 3) rate-active @endif"></i>
                        </label>
                        <label class="rate">
                            <input type="radio" name="rating" id="star4-edit" value="4"
                                   @if ($review->rating == 4) checked @endif>
                            <div class="face"></div>
                            <i class="far fa-star star four-star @if (4 <= $review->rating) fas @endif @if($review->rating == 4) rate-active @endif"></i>
                        </label>
                        <label class="rate">
                            <input type="radio" name="rating" id="star5-edit" value="5"
                                   @if ($review->rating == 5) checked @endif>
                            <div class="face"></div>
                            <i class="far fa-star star five-star @if (5 <= $review->rating) fas @endif @if($review->rating == 5) rate-active @endif"></i>
                        </label>
                    </div>
                </div>
            </div>

        </div>

        <button class="btn btn-primary">Update</button>

    </form>

@endif
