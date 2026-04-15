<div class="col-12">
    <label for="details"
           class="form-label">
        @if ($data->moduleRelation->title == 'videos' || $data->moduleRelation->title == 'video')
            {{ __('admin.embed_video') }}
        @else
            {{ __('admin.details') }}
        @endif
    </label>


    {{--                                            <div class="editor" data-target="content2"></div>--}}
    {{--                                            <textarea name="content2" id="content{{$v}}" hidden></textarea>--}}

    <div class="card">
        <div class="card-body">
            <div class="editor"
                 data-target="ooeditor{{$postLang->id}}">{!! $postLang->details  !!}</div>
        </div>
    </div>

    <textarea  hidden  id="ooeditor{{$postLang->id}}" class="form-control no-resize"

              name="details">{{ $postLang->details }} </textarea>

</div>
