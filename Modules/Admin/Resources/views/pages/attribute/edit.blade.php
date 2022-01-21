@extends('admin::layouts.master')

@section('css')
@endsection

@push('styles')
@endpush

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Attribute</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a type="button" class="btn btn-sm btn-outline-secondary" href="{{ route('admin.attribute.index') }}">
                Go Back
            </a>
        </div>
    </div>

    <div class="pt-3 pb-2 mb-3">
        <form
            action="{{ route('admin.attribute.update') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            <input type="hidden" name="id" value="{{ $attribute->id }}">

            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                            placeholder="Enter Attribute Name"
                            value="{{ $attribute->name }}"
                        >
                        <label for="name">Name</label>
                        @error('name')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <div class="form-floating">
                        <select
                            type="text"
                            class="form-control @error('category') is-invalid @enderror"
                            id="category"
                            name="category"
                        >
                            <option value="null" selected disabled>Select a category</option>
                            <option
                                value="services"
                                @if($attribute->category == 'services') selected @endif
                            >
                                Services
                            </option>
                            <option
                                value="jobs"
                                @if($attribute->category == 'jobs') selected @endif
                            >
                                Jobs
                            </option>
                            <option
                                value="motor-vehicles"
                                @if($attribute->category == 'motor-vehicles') selected @endif
                            >
                                Motor & Vehicles
                            </option>
                            <option
                                value="real-estate"
                                @if($attribute->category == 'real-estate') selected @endif
                            >
                                Real Estate
                            </option>
                            <option
                                value="accommodation"
                                @if($attribute->category == 'accommodation') selected @endif
                            >
                                Accommodation
                            </option>
                        </select>
                        <label for="category">Attribute Category</label>
                        @error('category')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <div class="form-floating">
                        <select
                            type="text"
                            class="form-control @error('type') is-invalid @enderror"
                            id="type"
                            name="type"
                        >
                            <option value="null" selected disabled>Select an attribute</option>
                            <option
                                value="text"
                                @if($attribute->type == 'text') selected @endif
                            >
                                Text
                            </option>
                            <option
                                value="radio"
                                @if($attribute->type == 'radio') selected @endif
                            >
                                Radio
                            </option>
                            <option
                                value="checkbox"
                                @if($attribute->type == 'checkbox') selected @endif
                            >
                                Checkbox
                            </option>
                            <option
                                value="textarea"
                                @if($attribute->type == 'textarea') selected @endif
                            >
                                TextArea
                            </option>
                            <option
                                value="select"
                                @if($attribute->type == 'select') selected @endif
                            >
                                Selection
                            </option>
                        </select>
                        <label for="type">Attribute type</label>
                        @error('type')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <div class="form-floating">
                        <select
                            type="text"
                            class="form-control @error('is_filterable') is-invalid @enderror"
                            id="is_filterable"
                            name="is_filterable"
                        >
                            <option
                                value="1"
                                @if($attribute->is_filterable == '1') selected @endif
                            >
                                Yes
                            </option>
                            <option
                                value="0"
                                @if($attribute->is_filterable == '0') selected @endif
                            >
                                No
                            </option>
                        </select>
                        <label for="is_filterable">Filterable</label>
                        @error('is_filterable')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

            </div>

            <div id="options_container"
                 class="@if($attribute->type != 'text' || $attribute->type != 'textarea') d-none @endif">
                <div class="row">
                    <div class="col-12 mb-1 ">
                        <label for="options"
                               class="h6 d-flex justify-content-between align-items-center border-bottom border-muted pb-2">
                            Attribute Options
                            <button type="button" class="btn btn-sm btn-primary add_btn">
                                <small>Add Options</small>
                            </button>
                        </label>
                    </div>
                </div>

                <div class="row append_fields">
                    @if($attribute->options)
                        @foreach($attribute->options as $option)
                            <div class="col-12 col-md-6 mb-3" id="option-{{ $loop->iteration }}">
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        @if($loop->iteration == 1) id="options" @endif
                                        name="options[]"
                                        placeholder="Option Value"
                                        value="{{ $option }}"
                                    >
                                    <button
                                        type="button"
                                        class="btn btn-secondary remove_btn"
                                        data-id="{{ $loop->iteration }}"
                                        onclick="removeItem({{ $loop->iteration }})"
                                    >
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <button type="submit" class="btn btn-primary px-5">Save</button>
        </form>
    </div>
@endsection

@section('js')
    <script>
        let i = {!! $attribute->options ? count($attribute->options) : 1 !!};
        $('.add_btn').click(function () {
            $.ajax({
                url: '/admin/attribute/add',
                data: {id: i},
                type: 'get',
                success: function (res) {
                    $('.append_fields').append(res)
                    i++;
                },
                error: function () {
                    console.log('error')
                }
            })
        })

        $('#type').change(function () {
            if ($(this).val() !== 'text' && $(this).val() !== 'textarea') {
                $('#options_container').removeClass('d-none')
            } else {
                $('#options_container').addClass('d-none')
            }
        })

        function removeItem(id) {
            $(`#option-${id}`).remove();
        }

    </script>
@endsection

@push('script')
@endpush
