<div class="col-12">
    <label for="details"
           class="form-label">
        {{-- @if (Request::segment(3) == 'videos' || Request::segment(3) == 'video') --}}
        {{-- {{ __('backend_lang/custom.embed_video') }} --}}
        {{-- @else --}}
        {{ __('admin.short') }}
        {{-- @endif --}}
    </label>


    {{--                                            <div class="editor" data-target="content2"></div>--}}
    {{--                                            <textarea name="content2" id="content{{$v}}" hidden></textarea>--}}


    <div class="card">
        <div class="card-body">
            <div class="editor"
                 data-target="details22{{ $postLang->short}}">{!! $postLang->short !!}</div>
        </div>
    </div>

    <textarea  hidden  id="details22{{ $postLang->short}}"
              class="form-control no-resize" hidden
              name="short">{{ $postLang->short }} </textarea>

</div>
