@extends('site::layouts.master')

@section('css')
@endsection

@push('styles')
@endpush

@section('meta')
    <x-meta-tag></x-meta-tag>
@endsection

@section('content')
    <div class="container mt-5 registernow pb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="bg-white shadow">
                    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="customer_account_tab" data-bs-toggle="tab"
                                    data-bs-target="#customer_account" type="button" role="tab"
                                    aria-controls="customer_account"
                                    aria-selected="true">
                                <div class="d-flex flex-column lh-lg"><i class='fas fa-user'></i>
                                    <span>Customer Account</span></div>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="business_account_tab" data-bs-toggle="tab"
                                    data-bs-target="#business_account"
                                    type="button" role="tab" aria-controls="business_account" aria-selected="false">
                                <div class="d-flex flex-column lh-lg"><i class='fas fa-shopping-bag'></i> <span>Business Account</span>
                                </div>
                            </button>
                        </li>

                    </ul>
                    <div class="tab-content" id="registrationTabContent">
                        <div
                            class="tab-pane fade active show"
                            id="customer_account"
                            role="tabpanel"
                            aria-labelledby="customer_account_tab"
                        >
                            <form
                                id="customer-registration-form"
                                method="POST"
                                action="{{ route('registration') }}"
                            >
                                @csrf
                                <!-- Role -->
                                <input
                                    type="hidden"
                                    id="customer_role"
                                    name="role"
                                    value="buyer"
                                >

                                <div class="container p-3">
                                    <div class="row">
                                        <!-- First Name -->
                                        <div class="col-md-6">
                                            <div class="form-group pt-2">
                                                <label
                                                    for="customer_first_name"
                                                    class="small mb-1 fw-bold text-dark"
                                                >
                                                    First Name
                                                </label>
                                                <input
                                                    type="text"
                                                    id="customer_first_name"
                                                    name="first_name"
                                                    class="form-control form-control-sm"
                                                    placeholder="Enter First Name"
                                                >
                                            </div>
                                        </div>
                                        <!-- Last Name -->
                                        <div class="col-md-6">
                                            <div class="form-group pt-2">
                                                <label
                                                    for="customer_last_name"
                                                    class="small mb-1 fw-bold text-dark"
                                                >
                                                    Last Name
                                                </label>
                                                <input
                                                    type="text"
                                                    id="customer_last_name"
                                                    name="last_name"
                                                    class="form-control form-control-sm"
                                                    placeholder="Enter Last Name"
                                                >
                                            </div>
                                        </div>
                                        <!-- Email -->
                                        <div class="col-md-6">
                                            <div class="form-group pt-2">
                                                <label
                                                    for="customer_email"
                                                    class="small mb-1 fw-bold text-dark"
                                                >
                                                    Email
                                                </label>
                                                <input
                                                    type="text"
                                                    id="customer_email"
                                                    name="email"
                                                    class="form-control form-control-sm"
                                                    placeholder="Enter Email"
                                                >
                                                <div class="form-text">
                                                    <small>Please review our
                                                        @include('site::partials.generals.privacy_policy')
                                                        for your privacy.
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Password -->
                                        <div class="col-md-6">
                                            <div class="form-group pt-2">
                                                <label
                                                    for="customer_password"
                                                    class="small mb-1 fw-bold text-dark"
                                                >
                                                    Password
                                                </label>
                                                <input
                                                    type="password"
                                                    id="customer_password"
                                                    name="password"
                                                    class="form-control form-control-sm"
                                                    placeholder="Enter Password"
                                                >
                                                <div class="form-text">
                                                    <small>At least 8 Characters, 1 Uppercase, 1 Digit, 1 Symbol</small>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Password Confirmation -->
                                        <div class="col-md-6">
                                            <div class="form-group pt-2">
                                                <label
                                                    for="customer_password_confirmation"
                                                    class="small mb-1 fw-bold text-dark"
                                                >
                                                    Confirm Password
                                                </label>
                                                <input
                                                    type="password"
                                                    id="customer_password_confirmation"
                                                    name="password_confirmation"
                                                    class="form-control form-control-sm"
                                                    placeholder="Enter Password"
                                                >
                                            </div>
                                        </div>
                                        <!-- Checkboxes -->
                                        <div class="col-md-12 pt-2">
                                            <div class="form-check pt-2">
                                                <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    value="1"
                                                    id="customer_policy"
                                                    name="has_accepted_policy"
                                                    onchange="checkIfCustomerAcceptedPolices()"
                                                >
                                                <label class="form-check-label" for="customer_policy">
                                                    I have read and agreed to the
                                                    @include('site::partials.generals.user_agreement')
                                                    and
                                                    @include('site::partials.generals.privacy_policy')
                                                    .
                                                </label>
                                            </div>

                                            <div class="form-check pt-2">
                                                <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    value="1"
                                                    id="customer_terms"
                                                    name="has_accepted_terms"
                                                    onchange="checkIfCustomerAcceptedPolices()"
                                                >
                                                <label class="form-check-label" for="customer_terms">
                                                    I accept the
                                                    @include('site::partials.generals.terms_and_conditions')
                                                    and all information provided by me is valid. If any misinformation
                                                    is provided then, I will be liable.
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12 pt-2">
                                        <button
                                            id="customer_submit"
                                            type="submit"
                                            class="btn-search btn btn-hover-primary px-5 py-2 rounded-0 bg-theme border-0"
                                            disabled="disabled"
                                        >
                                            Register
                                        </button>
                                    </div>

                                    @include('socialauth::index')

                                </div>
                            </form>
                        </div>

                        <div
                            class="tab-pane fade"
                            id="business_account"
                            role="tabpanel"
                            aria-labelledby="business_account_tab"
                        >
                            <form
                                id="business-registration-form"
                                method="POST"
                                action="{{ route('registration') }}"
                            >
                                @csrf
                                <!-- Role -->
                                <input
                                    type="hidden"
                                    id="business_role"
                                    name="role"
                                    value="seller"
                                >

                                <div class="container p-3 scroll-y">
                                    <div class="row">
                                        <!-- First Name -->
                                        <div class="col-md-6">
                                            <div class="form-group pt-2">
                                                <label
                                                    for="business_first_name"
                                                    class="small mb-1 fw-bold text-dark"
                                                >
                                                    First Name
                                                </label>
                                                <input
                                                    type="text"
                                                    id="business_first_name"
                                                    name="first_name"
                                                    class="form-control form-control-sm"
                                                    placeholder="Enter First Name"
                                                >
                                            </div>
                                        </div>
                                        <!-- Last Name -->
                                        <div class="col-md-6">
                                            <div class="form-group pt-2">
                                                <label
                                                    for="business_last_name"
                                                    class="small mb-1 fw-bold text-dark"
                                                >
                                                    Last Name
                                                </label>
                                                <input
                                                    type="text"
                                                    id="business_last_name"
                                                    name="last_name"
                                                    class="form-control form-control-sm"
                                                    placeholder="Enter Last Name"
                                                >
                                            </div>
                                        </div>
                                        <!-- Company Phone -->
                                        <div class="col-md-6">
                                            <div class="form-group pt-2">
                                                <label
                                                    for="business_company_number"
                                                    class="small mb-1 fw-bold text-dark"
                                                >
                                                    Company Phone
                                                </label>
                                                <input
                                                    type="text"
                                                    id="business_company_number"
                                                    name="company_number"
                                                    class="form-control form-control-sm"
                                                    placeholder="Enter Company Phone"
                                                >
                                            </div>
                                        </div>
                                        <!-- Company Name -->
                                        <div class="col-md-6">
                                            <div class="form-group pt-2">
                                                <label
                                                    for="business_company_name"
                                                    class="small mb-1 fw-bold text-dark"
                                                >
                                                    Company Name
                                                </label>
                                                <input
                                                    type="text"
                                                    id="business_company_name"
                                                    name="company_name"
                                                    class="form-control form-control-sm"
                                                    placeholder="Enter Company Name"
                                                >
                                            </div>
                                        </div>
                                        <!-- Company Email -->
                                        <div class="col-md-6">
                                            <div class="form-group pt-2">
                                                <label
                                                    for="business_company_email"
                                                    class="small mb-1 fw-bold text-dark"
                                                >
                                                    Company Email
                                                </label>
                                                <input
                                                    type="text"
                                                    id="business_company_email"
                                                    name="company_email"
                                                    class="form-control form-control-sm"
                                                    placeholder="Enter Company Email"
                                                >
                                            </div>
                                        </div>
                                        <!-- Company Document -->
                                        <div class="col-md-6">
                                            <div class="form-group pt-2">
                                                <label
                                                    for="business_company_document"
                                                    class="small mb-1 fw-bold text-dark"
                                                >
                                                    Company Document
                                                </label>
                                                <input
                                                    type="text"
                                                    id="business_company_document"
                                                    name="company_document"
                                                    class="form-control form-control-sm"
                                                    placeholder="Enter Company Document"
                                                >
                                            </div>
                                        </div>
                                        <!-- Email -->
                                        <div class="col-md-6">
                                            <div class="form-group pt-2">
                                                <label
                                                    for="business_email"
                                                    class="small mb-1 fw-bold text-dark"
                                                >
                                                    Personal Email
                                                </label>
                                                <input
                                                    type="text"
                                                    id="business_email"
                                                    name="email"
                                                    class="form-control form-control-sm"
                                                    placeholder="Enter Email"
                                                >
                                                <div class="form-text">
                                                    <small>Please review our
                                                        @include('site::partials.generals.privacy_policy')
                                                        for your privacy.
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Password -->
                                        <div class="col-md-6">
                                            <div class="form-group pt-2">
                                                <label
                                                    for="business_password"
                                                    class="small mb-1 fw-bold text-dark"
                                                >
                                                    Password
                                                </label>
                                                <input
                                                    type="password"
                                                    id="business_password"
                                                    name="password"
                                                    class="form-control form-control-sm"
                                                    placeholder="Enter Password"
                                                >
                                                <div class="form-text">
                                                    <small>At least 8 Characters, 1 Uppercase, 1 Digit, 1 Symbol</small>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Password Confirmation -->
                                        <div class="col-md-6">
                                            <div class="form-group pt-2">
                                                <label
                                                    for="business_password_confirmation"
                                                    class="small mb-1 fw-bold text-dark"
                                                >
                                                    Confirm Password
                                                </label>
                                                <input
                                                    type="password"
                                                    id="business_password_confirmation"
                                                    name="password_confirmation"
                                                    class="form-control form-control-sm"
                                                    placeholder="Enter Password"
                                                >
                                            </div>
                                        </div>
                                        <!-- Checkboxes -->
                                        <div class="col-md-12 pt-2">
                                            <div class="form-check pt-2">
                                                <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    value="1"
                                                    id="business_policy"
                                                    name="has_accepted_policy"
                                                    onchange="checkIfBusinessAcceptedPolices()"
                                                >
                                                <label class="form-check-label" for="business_policy">
                                                    I have read and agreed to the
                                                    @include('site::partials.generals.user_agreement')
                                                    and
                                                    @include('site::partials.generals.privacy_policy')
                                                    .
                                                </label>
                                            </div>

                                            <div class="form-check pt-2">
                                                <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    value="1"
                                                    id="business_terms"
                                                    name="has_accepted_terms"
                                                    onchange="checkIfBusinessAcceptedPolices()"
                                                >
                                                <label class="form-check-label" for="business_terms">
                                                    I accept the
                                                    @include('site::partials.generals.terms_and_conditions')
                                                    and all information provided by me is valid. If any misinformation
                                                    is provided then, I will be liable.
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12 pt-2">
                                        <button
                                            id="business_submit"
                                            type="submit"
                                            class="btn-search btn btn-hover-primary px-5 py-2 rounded-0 bg-theme border-0"
                                            disabled="disabled"
                                        >
                                            Register
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/validation/customer-registration.js') }}"></script>
    <script src="{{ asset('js/validation/business-registration.js') }}"></script>
@endsection

@push('script')
@endpush
