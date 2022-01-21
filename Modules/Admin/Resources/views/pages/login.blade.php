@extends('admin::layouts.guest')

@section('css')
@endsection

@push('styles')
@endpush

@section('meta')
    <x-meta-tag></x-meta-tag>
@endsection

@section('content')
    <div class="text-center d-flex align-items-center justify-content-center" style="height: 90vh">
        <main class="form-signin">
            <form
                action="{{ route('admin.login') }}"
                method="POST"
            >
                @csrf

                <img class="mb-4" src="{{ asset('images/site/logo.png') }}" alt="" width="180" height="60">
                <h5 class=" fw-normal">Welcome Back</h5>
                <p class="mb-3 fw-normal">Please sign in to continue</p>

                <div class="form-floating">
                    <input
                        type="text"
                        id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        name="email"
                        placeholder="Email Address"
                        value="{{ old('email') }}"
                    >
                    <label for="email">Email Address</label>
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input
                        type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        id="password"
                        name="password"
                        placeholder="Password"
                    >
                    <label for="password">Password</label>
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                @if(Session::has('error'))
                    <div class="form-group">
                        <div class="invalid-feedback d-block mt-3" role="alert">
                            {{ session()->get('error')  }}
                        </div>
                    </div>
                @endif

                <button class="w-100 btn btn-lg btn-primary mt-3">Login</button>
                <p class="mt-5 mb-3 text-muted">© {{ now()->year }} {{ env('APP_NAME') }}</p>
            </form>
        </main>
    </div>
@endsection

@section('js')
@endsection

@push('script')
@endpush
