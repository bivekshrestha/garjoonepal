@extends('admin::layouts.master')

@section('css')
@endsection

@push('styles')
@endpush

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Country List</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
{{--                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>--}}
{{--                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>--}}
            </div>
            <a type="button" class="btn btn-sm btn-outline-secondary" href="{{ route('admin.country.create') }}">
                Add New
            </a>
        </div>
    </div>

    <div>
        <x-data-table
            route="admin.country"
            :items="$categories"
            :columns="['name', 'iso_code', 'phone_code']"
            :sort="['name', 'iso_code', 'phone_code']"
        >
        </x-data-table>
@endsection

@section('js')
@endsection

@push('script')
@endpush
