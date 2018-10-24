@extends('registry::layouts.table')

@section('heading')
    <div class="d-flex justify-content-between">
        <span class="h1">@lang('registry::all.registry')</span>
        <div class="mt-2">
            <ul class="list-group list-inline">
                <li><a href="{{ route('registry.create') }}" class="btn btn-primary">@lang('registry::all.add_new_item')</a></li>
            </ul>
        </div>
    </div>
@endsection

@section('table')

    @if (!$registry->isEmpty())
        <table class="table table-striped mt-3">
            <thead>
            <tr>
                <th>@lang('registry::all.key')</th>
                <th>@lang('registry::all.type')</th>
                <th>@lang('registry::all.value')</th>
                <th>@lang('registry::all.comment')</th>
                <th>@lang('registry::all.action')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($registry as $item)
                <tr>
                    <td>{{ $item->key }}</td>
                    <td>{{ $item->type }}</td>
                    <td>{{ str_limit($item->value, 20) }}</td>
                    <td>{{ str_limit($item->comment, 50) }}</td>
                    <td class="d-flex">
                        <div class="mr-2">
                            <form action="{{ route('registry.destroy', $item->id) }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" onclick="return confirm('@lang('registry::all.delete')');" class="btn btn-sm btn-outline-danger">@lang('registry::all.delete')</button>
                            </form>
                        </div>
                        <div class="mr-2">
                            <a title="Modify" class="btn btn-sm btn-outline-info"
                               href="{{ route('registry.edit', $item->id) }}">@lang('registry::all.edit_item')</a>
                        </div>
                        <div>
                            <a title="Show" class="btn btn-sm btn-outline-info"
                               href="{{ route('registry.show', $item->id) }}">@lang('registry::all.show_item')</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            <tbody>
        </table>
    @else
        @lang('registry::all.no_data')
    @endif

@endsection
