{{--<div class="d-flex mt-3">--}}
{{--    <input--}}
{{--        type="text"--}}
{{--        name="items[]"--}}
{{--        class="form-control form-control-alternative{{ $errors->has('items') ? ' is-invalid' : '' }}"--}}
{{--        placeholder="Enter Package Item"--}}
{{--    >--}}
{{--    <button type="button" class="btn btn-outline-danger ml-3 rounded remove-item-btn" id="remove-item-{{ $id }}"--}}

{{--    >--}}
{{--        --}}
{{--    </button>--}}
{{--</div>--}}

<div class="col-12 col-md-6 mb-3" id="option-{{ $id }}">
    <div class="input-group">
        <input
            type="text"
            class="form-control"
            @if($id == 1) id="options" @endif
            name="options[]"
            placeholder="Option Value"
            value="{{ old('options') }}"
        >
        <button
            type="button"
            class="btn btn-secondary remove_btn"
            data-id="{{ $id }}"
            onclick="removeItem({{ $id }})"
        >
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>
