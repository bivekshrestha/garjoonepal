@extends('profile::layout')

@section('meta')
    <x-meta-tag></x-meta-tag>
@endsection

@section('childContent')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Ads</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                {{--                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>--}}
                {{--                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>--}}
            </div>
            <a type="button" class="btn btn-sm btn-outline-secondary" href="{{ route('my-ad.add') }}">
                Add New
            </a>
        </div>
    </div>

    <div>
        <x-data-table
            route="my-ad"
            :items="$ads"
            :columns="['title', 'price', 'category_id']"
            :sort="['title', 'price']"
        >
            <x-slot name="category_id">
                @verbatim
                    {{ $item->category ? $item->category->name : 'Root' }}
                @endverbatim
            </x-slot>
            <x-slot name="actions">
                @verbatim
{{--                <a class="btn btn-outline-secondary btn-sm" href="{{ route('ad.show', $item->slug) }} ">--}}
{{--                    <i class="fa fa-eye"></i>--}}
{{--                </a>--}}
                @endverbatim
            </x-slot>
        </x-data-table>
@endsection
