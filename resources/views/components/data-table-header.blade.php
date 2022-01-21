<div class="d-flex justify-content-between align-items-center mb-2">
    <div class="d-flex align-items-center">
        Display
        <form
            class="form-inline ms-2"
            method="GET"
            action="{{ route($route) }}"
        >
            <!-- Other Filters  -->
            @if(request()->has('keyword'))
                <input type="hidden" name="keyword" value="{{ request()->keyword }}">
            @endif

            @if(request()->has('sort_by'))
                <input type="hidden" name="sort_by" value="{{ request()->sort_by }}">
            @endif

            @if(request()->has('sort_order'))
                <input type="hidden" name="sort_order" value="{{ request()->sort_order }}">
            @endif
            <!-- End of Other Filters  -->

            <!-- Size  -->
            <select class="form-select" name="size" onchange="this.form.submit()">
                <option value="10" @if(request()->has('size')) @if(request()->size == 10) selected
                        @endif  @else selected @endif>10
                </option>
                <option value="25" @if(request()->size == 25) selected @endif>25</option>
                <option value="50" @if(request()->size == 50) selected @endif>50</option>
                <option value="100" @if(request()->size == 100) selected @endif>100</option>
            </select>
            <!-- End of Size  -->
        </form>
        &nbsp; Items
    </div>
    <div class="d-flex">
        <form
            class="form-inline"
            method="GET"
            action="{{ route($route) }}"
        >

            <!-- Other Filters  -->
            @if(request()->has('size'))
                <input type="hidden" name="size" value="{{ request()->size }}">
            @endif

            @if(request()->has('sort_by'))
                <input type="hidden" name="sort_by" value="{{ request()->sort_by }}">
            @endif

            @if(request()->has('sort_order'))
                <input type="hidden" name="sort_order" value="{{ request()->sort_order }}">
            @endif
            <!-- End of Other Filters  -->

            <!-- Keyword  -->
            <div class="input-group">
                <input class="form-control border border-secondary" type="search" name="keyword" placeholder="Search"
                       aria-label="Search"
                       value="{{ request()->keyword }}">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary my-2 my-sm-0 rounded-0 h-100" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            <!-- End of Keyword  -->
        </form>

        @if(count(request()->input()) > 0)
            <a class="btn btn-outline-danger ml-3" href="{{ route($route) }}">Reset All</a>
        @endif
    </div>
</div>
