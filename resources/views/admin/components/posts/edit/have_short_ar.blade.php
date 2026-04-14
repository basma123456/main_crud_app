<div class="col-12"
     @if (Request::segment(3) == 'videos' || Request::segment(3) == 'video') hidden @endif>
    <label for="details"
           class="form-label">{{ __('backend_lang/custom.short') }}</label>


    <div class="card">
        <div class="card-body">
            <div class="editor_ar"
                 data-target="contentvid{{$postLang->short}}">{!! $postLang->short !!}</div>
        </div>
    </div>

    <textarea  hidden  id="contentvid{{$postLang->short}}"
              class="form-control no-resize"
              hidden
              style="direction:rtl;"
              name="short_ar">{{ $postLang->short }} </textarea>

    {{--                                            <div class="editor" data-target="content2"></div>--}}
    {{--                                            <textarea name="content2" id="content{{$v}}" hidden></textarea>--}}


</div>

