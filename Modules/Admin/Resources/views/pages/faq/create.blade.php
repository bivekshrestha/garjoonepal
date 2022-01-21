@extends('admin::layouts.master')

@section('css')
@endsection

@push('styles')
@endpush

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add FAQ</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a type="button" class="btn btn-sm btn-outline-secondary" href="{{ route('admin.faq.index') }}">
                Go Back
            </a>
        </div>
    </div>

    <div class="pt-3 pb-2 mb-3">
        <form
            action="{{ route('admin.faq.store') }}"
            method="POST"
        >
            @csrf

            <div class="row">

                <div class="col-12 mb-3">
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control @error('question') is-invalid @enderror"
                            id="question"
                            name="question"
                            placeholder="Enter Question"
                            value="{{ old('question') }}"
                        >
                        <label for="question">Question</label>
                        @error('question')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <div class="form-floating">
                        <textarea
                            class="form-control @error('answer') is-invalid @enderror"
                            id="answer"
                            name="answer"
                            rows="5"
                            style="min-height: 120px"
                        >{{ old('answer') }}</textarea>
                        <label for="answer">Answer</label>
                        @error('answer')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

            </div>

            <button type="submit" class="btn btn-primary px-5">Save</button>
        </form>
    </div>
@endsection

@section('js')
@endsection

@push('script')
@endpush
