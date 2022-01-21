@if(auth()->id() == $review->user_id)
    <form
        action="{{ route('review.delete') }}"
        method="POST"
        class="ms-5"
    >
        @csrf
        @method('DELETE')
        <input type="hidden" name="id" value="{{ $review->id }}">
        <button
            title="Delete"
            type="submit"
            class="btn btn-outline-danger btn-sm rounded-circle"
        >
            <i class="fa fa-trash"></i>
        </button>
    </form>
@endif
