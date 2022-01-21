@extends('site::layouts.master')

@section('css')
@endsection

@push('styles')
@endpush

@section('meta')
    <x-meta-tag></x-meta-tag>
@endsection

@section('content')
    <div class="container p-5">
        <p>Dear {{ session()->get('user')  }},</p>
        <p>Please activate your account to proceed.</p>
        <p>
            You can activate your account through activation link. <br> An activation link has been sent to your email.
        </p>
        <p>
            If you have already activated your account, then please <a class="btn btn-outline-primary btn-sm" href="{{ route('login') }}">Login</a>.
        </p>
        <br>
        <p>If you have any trouble activating your account, then please contact us at info@garjoonepal.com,</p>
        <p>Garjoo Nepal</p>
    </div>
@endsection

@section('js')
    <script>
        let submit = document.getElementById('submit');
        let policy = document.getElementById('policy');
        let terms = document.getElementById('terms');

        function checker() {
            submit.disabled = !(policy.checked && terms.checked);
        }
    </script>
@endsection

@push('script')
@endpush
