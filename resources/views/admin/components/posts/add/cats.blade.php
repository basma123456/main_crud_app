<div class="col-md-6">
    <label for="cat"
           class="form-label">{{ __('admin.sub_from') }}</label>
    <select name="cat"
            id="select"
            class="form-select select2">
        <option value="">
            {{ __('admin.select_cat') }}
        </option>

        @foreach ($cat as $row)
            <option
                value="{{ $row->id }}"
                @if ( $row->id== old('cat')) selected @endif>
                @if ($row->main_cat == 0)
                    {{ $row->name}}
                @else
                    __{{ $row->name}}
                @endif

            </option>
        @endforeach
    </select>
</div>
