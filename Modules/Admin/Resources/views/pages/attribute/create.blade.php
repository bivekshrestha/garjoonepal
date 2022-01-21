@extends('admin::layouts.master')

@section('css')
@endsection

@push('styles')
@endpush

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Attribute</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a type="button" class="btn btn-sm btn-outline-secondary" href="{{ route('admin.attribute.index') }}">
                Go Back
            </a>
        </div>
    </div>

    <div class="pt-3 pb-2 mb-3">
        <form
            action="{{ route('admin.attribute.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                            placeholder="Enter Attribute Name"
                            value="{{ old('name') }}"
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
                                @if(old('category') == 'services') selected @endif
                            >
                                Services
                            </option>
                            <option
                                value="jobs"
                                @if(old('category') == 'jobs') selected @endif
                            >
                                Jobs
                            </option>
                            <option
                                value="motor-vehicles"
                                @if(old('category') == 'motor-vehicles') selected @endif
                            >
                                Motor & Vehicles
                            </option>
                            <option
                                value="real-estate"
                                @if(old('category') == 'real-estate') selected @endif
                            >
                                Real Estate
                            </option>
                            <option
                                value="accommodation"
                                @if(old('category') == 'accommodation') selected @endif
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
                                @if(old('type') == 'text') selected @endif
                            >
                                Text
                            </option>
                            <option
                                value="radio"
                                @if(old('type') == 'radio') selected @endif
                            >
                                Radio
                            </option>
                            <option
                                value="checkbox"
                                @if(old('type') == 'checkbox') selected @endif
                            >
                                Checkbox
                            </option>
                            <option
                                value="textarea"
                                @if(old('type') == 'textarea') selected @endif
                            >
                                TextArea
                            </option>
                            <option
                                value="select"
                                @if(old('type') == 'select') selected @endif
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
                                @if(old('is_filterable') == '1') selected @endif
                            >
                                Yes
                            </option>
                            <option
                                value="0"
                                @if(old('is_filterable') == '0') selected @endif
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

            <div class="row d-none" id="options_container">
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

            </div>

            <button type="submit" class="btn btn-primary px-5">Save</button>
        </form>
    </div>
@endsection

@section('js')
    <script>
        let i = 1;
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
