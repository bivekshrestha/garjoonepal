@extends('admin::layouts.master')

@section('css')
@endsection

@push('styles')
@endpush

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Category List</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
{{--                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>--}}
{{--                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>--}}
            </div>
            <a type="button" class="btn btn-sm btn-outline-secondary" href="{{ route('admin.category.create') }}">
                Add New
            </a>
        </div>
    </div>

    <div>
        <x-data-table
            route="admin.category"
            :items="$categories"
            :columns="['name', 'status', 'parent_id']"
            :sort="['name', 'status']"
        >
            <x-slot name="status">
                @verbatim
                    @if($item[$column] == 1)
                        Active
                    @else
                        Inactive
                    @endif
                @endverbatim
            </x-slot>

            <x-slot name="parent_id">
                @verbatim
                    {{ $item->parent ? $item->parent->name : 'Root' }}
                @endverbatim
            </x-slot>
        </x-data-table>
@endsection

@section('js')
@endsection

@push('script')
@endpush
