@if (!empty($errors->all()))
    <p>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        <ul>
            @foreach($errors->all() as $error)
                <li class="list-unstyled">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    </p>
@endif
