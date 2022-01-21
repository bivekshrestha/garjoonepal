@extends('profile::layout')

@section('meta')
    <x-meta-tag></x-meta-tag>
@endsection

@section('childContent')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-12">
                                <h5>Change your password</h5>

                            </div>
                            <div class="col-md-12">
                                <p>
                                    Please make sure you use a secure password.
                                </p>
                                <form
                                    action="{{ route('user.account.changePassword') }}"
                                    method="POST"
                                >
                                    @csrf

                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="form-floating">
                                                <input
                                                    type="password"
                                                    class="form-control @error('old_password') is-invalid @enderror"
                                                    id="old_password"
                                                    name="old_password"
                                                    value="{{ old('old_password') }}"
                                                >
                                                <label for="old_password">Old Password</label>
                                                @error('old_password')
                                                <div class="invalid-feedback d-block">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-6"></div>

                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="form-floating">
                                                <input
                                                    type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="password"
                                                    name="password"
                                                >
                                                <label for="password">Password</label>
                                                @error('password')
                                                <div class="invalid-feedback d-block">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="col-12 col-6"></div>

                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="form-floating">
                                                <input
                                                    type="password"
                                                    class="form-control  @error('password_confirmation') is-invalid @enderror"
                                                    id="password_confirmation"
                                                    name="password_confirmation"
                                                >
                                                <label for="password_confirmation">Password Confirmation</label>
                                                @error('password_confirmation')
                                                <div class="invalid-feedback d-block">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn-primary px-5">Change Password</button>

                                </form>
                            </div>
                            <!--  col.// -->
                        </div>
                        <!--  row.// -->
                    </div>
                    <!--  card-body.// -->
                </div>
            </div>
        </div>
    </div>
@endsection
