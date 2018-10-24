@extends('registry::layouts.table')

@section('heading')
    <div class="d-flex justify-content-between">
        <span class="h1">{{ $registry->key }}</span>
    </div>
@endsection

@section('table')
    <table class="table table-striped mt-3">
        <tr>
            <td>@lang('registry::all.type')</td>
            <td>{{ $registry->type }}</td>
        </tr>
        <tr>
            <td>@lang('registry::all.value')</td>
            <td>{{ $registry->value }}</td>
        </tr>
        <tr>
            <td>@lang('registry::all.comment')</td>
            <td>{{ $registry->comment }}</td>
        </tr>
        <tr>
            <td>@lang('registry::all.code')</td>
            <td>
                <p>
                    <code>registry('{{ $registry->key }}');</code>
                </p>
                <p>
                    <code>Registry::get('{{ $registry->key }}');</code>
                </p>
                <p>
                    <code>config('{{ config('registry.settings.config_key', 'registry') . '.' . $registry->key }}
                        ');</code>
                </p>
            </td>
        </tr>
        <tr>
            <td>@lang('registry::all.result')</td>
            <td><code>{{ $registry->getConfigValueAsString() }}</code></td>
        </tr>
    </table>
@endsection
