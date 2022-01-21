@extends('admin::layouts.master')

@section('css')
@endsection

@push('styles')
@endpush

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Attribute List</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                {{--                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>--}}
                {{--                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>--}}
            </div>
            <a type="button" class="btn btn-sm btn-outline-secondary" href="{{ route('admin.attribute.create') }}">
                Add New
            </a>
        </div>
    </div>

    <div>
        <x-data-table
            route="admin.attribute"
            :items="$attributes"
            :columns="['name', 'is_filterable', 'type', 'category']"
            :sort="['name', 'is_filterable', 'type', 'category']"
        >
            <x-slot name="is_filterable">
                @verbatim
                    @if($item[$column] == 1)
                        Yes
                    @else
                        No
                    @endif
                @endverbatim
            </x-slot>
        </x-data-table>
@endsection

@section('js')
@endsection

@push('script')
@endpush
