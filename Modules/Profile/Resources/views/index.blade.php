@extends('profile::layout')

@section('meta')
    <x-meta-tag></x-meta-tag>
@endsection

@section('childContent')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header bg-app-primary" style="height:150px">
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl col-lg flex-grow-0" style="flex-basis:230px">
                                <div class="w-100 position-relative text-center p-1"
                                     style="margin-top:-120px">
                                    <img src="{{ asset('static/site/profile.png') }}"
                                         class="center-xy img-fluid img-thumbnail shadow rounded-circle"
                                         alt="Logo Brand"
                                         style="height:200px; width:200px;">
                                </div>
                            </div>
                            <!--  col.// -->
                            <div class="col-xl col-lg">
                                <h3>@userName()</h3>
                                <p>
                                                                  @foreach(auth()->user()->roles->pluck('name') as $role)
                                        {{ $role }}
                                        @if(!$loop->last)
                                            |
                                        @endif
                                    @endforeach
                                </p>
                            </div>
                            <!--  col.// -->
                        </div>
                        <!-- card-body.// -->
                        <hr class="my-4">
                        <div class="row g-4">
                            <div class="col-md-12">
                                <form
                                    action="{{ route('user.account.update') }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="form-floating">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="first_name"
                                                    name="first_name"
                                                    value="{{ $user->first_name }}"
                                                >
                                                <label for="first_name">First Name</label>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="form-floating">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="last_name"
                                                    name="last_name"
                                                    value="{{ $user->last_name }}"
                                                >
                                                <label for="last_name">Last Name</label>
                                            </div>
                                        </div>

                                        @if(session('activeRole') == 'seller')
                                            <div class="col-12 col-md-6 mb-3">
                                                <div class="form-floating">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="company_name"
                                                        name="company_name"
                                                        value="{{ $user->company_name }}"
                                                    >
                                                    <label for="company_name">Company Name</label>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6 mb-3">
                                                <div class="form-floating">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="company_number"
                                                        name="company_number"
                                                        value="{{ $user->company_number }}"
                                                    >
                                                    <label for="company_number">Company Number</label>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6 mb-3">
                                                <div class="form-floating">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="company_email"
                                                        name="company_email"
                                                        value="{{ $user->company_email }}"
                                                    >
                                                    <label for="company_email">Company Email</label>
                                                </div>
                                            </div>
                                            @endif
                                    </div>

                                    <button class="btn btn-primary px-5">Update Details</button>

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
