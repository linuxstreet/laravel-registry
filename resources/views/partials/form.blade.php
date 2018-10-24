<div class="form-group">
    <input type="hidden" name="id" value="{{ $registry->id ?? 0 }}">
    <label for="key" class="col-md-4 control-label">@lang('registry::all.key')</label>
    <div class="col-md-6">
        @if ($registry)
            <input type="hidden" name="key" value="{{ $registry->key }}">
            <input id="key" type="text" name="edit_key" class="form-control" readonly value="{{ $registry->key }}">
        @else
            <input type="text" value="{{ $registry->key ?? old('key') }}" name="key" id="key" autocomplete="off" required
                   class="form-control">
        @endif
    </div>
</div>

<div class="form-group">
    <label for="type" class="col-md-4 control-label">@lang('registry::all.type')</label>

    <div class="col-md-6">
        <select id="type" name="type" autocomplete="off" required class="form-control">
            @foreach($types as $type)
                @if ($registry)
                    <option{{ ($registry->type === $type) ? ' selected' : '' }}>{{ $type }}</option>
                @else
                    <option{{ ($type === old('type')) ? ' selected' : '' }}>{{ $type }}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <label for="value" class="col-md-4 control-label">@lang('registry::all.value')</label>

    <div class="col-md-6">
        <input type="text" value="{{ $registry->value ?? old('value') }}" name="value" id="value" autocomplete="off" required
               class="form-control">
    </div>
</div>

<div class="form-group">
    <label for="comment" class="col-md-4 control-label">@lang('registry::all.comment')</label>

    <div class="col-md-6">
        <textarea
            name="comment"
            id="comment"
            class="form-control"
            rows="4"
            autocomplete="off"
            placeholder="Comment...">{{ $registry->comment ?? old('comment') }}</textarea>
    </div>
</div>
