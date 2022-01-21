<form method="GET" action="{{ route($route . '.index') }}">

    <!-- Other Filters  -->
    @if(request()->has('size'))
        <input type="hidden" name="size" value="{{ request()->size }}">
    @endif

    @if(request()->has('keyword'))
        <input type="hidden" name="keyword" value="{{ request()->keyword }}">
    @endif
    <!-- End of Other Filters  -->

    <!-- Sort By -->
    <input type="hidden" value="{{ $column }}" name="sort_by">
    <!-- End of Sort By -->

    <!-- Sort Order -->
    <!--
    Check if sort filter is already selected
    & check if selected sort is current column
    & if sort order is ascending(asc), show next possible sort order i.e. descending(desc)
     -->
    @if(request()->has('sort_by') && request()->sort_by == $column && request()->sort_order == 'asc')
        <input type="hidden" value="desc" name="sort_order">
    @else
        <input type="hidden" value="asc" name="sort_order">
    @endif
    <!-- End of Sort Order -->

    <!-- Submit -->
    <button class="btn filter-btn py-0" type="submit">
        @if(request()->has('sort_by') && request()->sort_by == $column)
            @if(request()->sort_order == 'asc')
                <i class="fa fa-sort-amount-up"></i>
            @else
                <i class="fa fa-sort-amount-down-alt"></i>
            @endif
        @else
            <i class="fa fa-sort-amount-up text-muted"></i>
        @endif
    </button>
    <!-- End of Submit -->
</form>
