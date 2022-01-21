@extends('site::layouts.master')

@section('css')
@endsection

@push('styles')
@endpush

@section('meta')
    <x-meta-tag></x-meta-tag>
@endsection

@section('content')
    <!-- Hero section starts here -->
    @include('site::pages.includes.hero')

    <!-- New Arrival Product section starts here -->
    @include('site::pages.includes.newArrival')

    <!-- Popular Category section starts -->
    @include('site::pages.includes.popularCategory')

    <!-- MEN'S FASHION  Product section starts -->
    @include('site::pages.includes.menFashion')

    <!-- Garjoo classified Ad starts here -->
    @include('site::pages.includes.advertisement')

    <!-- CTA button starts -->
    @include('site::pages.includes.cta')
@endsection

@section('js')
@endsection

@push('script')
@endpush
