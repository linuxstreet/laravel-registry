@extends('registry::layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('registry::partials.errors')
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @yield('heading')
                    </div>
                    <div class="panel-body">
                        @yield('table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection