@extends('registry::layouts.table')

@section('heading')
    <div class="d-flex justify-content-between">
        <span class="h1">@lang('registry::all.create_new')</span>
    </div>
@endsection

@section('table')
    <hr>
    <form method="post" action="{{ route('registry.store') }}" role="form" class="form-horizontal">
        @csrf
        @include('registry::partials.form')
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">@lang('registry::all.create_new')</button>
            </div>
        </div>
    </form>
@endsection
