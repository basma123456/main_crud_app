<div class="col-12"
     @if (Request::segment(3) == 'videos' || Request::segment(3) == 'video') hidden @endif>
    <label for="details"
           class="form-label">{{ __('backend_lang/custom.details') }}</label>

    <div class="card"   >
        <div class="card-body">
            <div class="editor_ar"  dir="rtl" style="text-align: right;"

                 data-target="details_ar_{{$postLang->row_id}}">{!! $postLang->details !!}</div>
        </div>
    </div>


{{--    <textarea  hidden  id="details_ar_{{$postLang->row_id}}"--}}
{{--              class="form-control no-resize"--}}
{{--              style="direction:rtl;"--}}
{{--              name="details_ar">{{ $postLang->details }} </textarea>--}}

</div>
