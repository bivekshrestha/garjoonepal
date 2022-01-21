@extends('site::layouts.master')

@section('css')
@endsection

@push('styles')
@endpush

@section('meta')
    <x-meta-tag></x-meta-tag>
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Sign In</h5>
                        <form
                            class="form-signin"
                            action="{{ route('login') }}"
                            method="POST"
                        >
                            @csrf
                            <div class="form-label-group">
                                <label for="email">Email address</label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="Email address"
                                    required
                                    autofocus
                                >
                            </div>
                            <div class="form-label-group">
                                <label for="password">Password</label>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Password"
                                    required
                                >
                            </div>
                            <div class="fp mb-3">
                                <a href="">Forget Password?</a>
                            </div>
                            @if(Session::has('error'))
                                <div class="form-group">
                                    <div class="invalid-feedback d-block mb-3" role="alert">
                                        {{ session()->get('error')  }}
                                    </div>
                                </div>
                            @endif
                            <button
                                class="btn btn-lg btn-hover-primary btn-block text-capitalize w-100 rounded-0 mybtn1 bg-green text-white"
                                type="submit">
                                Sign In
                            </button>

                            @include('socialauth::index')

                            <div class="notreg text-center mt-2">
                                <p>Not Registered Yet? <span><a
                                            href="{{ route('registration') }}">Register Now</a></span></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection

@push('script')
@endpush
