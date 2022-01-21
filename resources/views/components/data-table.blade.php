<x-data-table-header route="{{ $route . '.index'}}"></x-data-table-header>

<table class="table table-hover">
    <thead>
    <tr>
        <th>#</th>
        @foreach($columns as $column)
            <th>
                <div class="d-flex justify-content align-items-center text-capitalize">
                    {{ Str::of($column)->replace('_id', '')->replace('_', ' ')}}

                    @if(in_array($column, $sort))
                        <x-data-table-column-sorter
                            :route="$route"
                            :column="$column"
                        ></x-data-table-column-sorter>
                    @endif
                </div>
            </th>
        @endforeach
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            @foreach($columns as $column)
                <td class="text-capitalize">
                    @if(!isset(${$column}))
                        {{ $item[$column] }}
                    @else
                        {!! eval('?>'.Blade::compileString(${$column})) !!}
                    @endif
                </td>
            @endforeach
            <td class="text-capitalize">
                <div class="d-flex align-items-center">
                    @if(isset($actions))
                        {!! eval('?>'.Blade::compileString($actions)) !!}
                    @else

                        <form
                            class="me-2"
                            method="GET"
                            action="{{ route($route . '.show') }}"
                        >
                            @csrf

                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="fa fa-eye"></i>
                            </button>
                        </form>
                        <form
                            class="me-2"
                            method="GET"
                            action="{{ route($route . '.edit') }}"
                        >
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <button class="btn btn-outline-primary btn-sm">
                                <i class="fa fa-edit"></i>
                            </button>
                        </form>
                        <form
                            method="POST"
                            action="{{ route($route . '.delete') }}"
                        >
                            @csrf
                            @method('DELETE')

                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <button class="btn btn-outline-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    @endif
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $items->appends(request()->input())->links() }}
