@extends('registry::layouts.table')

@section('heading')
    <div class="d-flex justify-content-between">
        <span class="h1">@lang('registry::all.edit'): {{ $registry->key }}</span>
    </div>
@endsection

@section('table')
    <hr>
    <form action="{{ route('registry.update', $registry) }}" method="post" role="form" class="form-horizontal">
        @method('patch')
        @csrf
        @include('registry::partials.form')
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">@lang('registry::all.update')</button>
            </div>
        </div>
    </form>
@endsection
