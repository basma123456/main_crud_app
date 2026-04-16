@if($case=="texts_arabic")
    <?php if($moduleRow->txts > 0){
    $nms = explode(',', $moduleRow->txts_names);
    for($ii = 0;$ii < $moduleRow->txts;$ii++){
    ?>
    <div class="col-md-6" style="direction:rtl;">
        <label class="form-label">
            @if ($nms[$ii] != 'add_date')
                {{ __('admin.' . $nms[$ii])  }}
            @else
                {{ __('admin.date') }}
            @endif
        </label>
        @if ($nms[$ii] != 'add_date')
            <input type="text" name="txt_ar[]" value="{{old('txt_ar' . $ii)}}"
                   class="form-control"/>
        @elseif($nms[$ii] == 'Youtube Video Link')
            <input name="txt_ar[0]" value="{{old('txt_ar.' . 0)}}" type="text"
                   class="form-control"
                   style="text-align: left !important;"/>
        @else
            <input name="txt_ar[0]" type="date" class="form-control"
                   value="{{ old('txt_ar.' . 0) ?? date('Y/m/d') }}"/>
        @endif
    </div>
    <?php }}?>
@endif

@if($case=="areas_arabic")
    <?php
    if($moduleRow->areas > 0){
    $nms = explode(',', $moduleRow->areas_names);
    for($ii = 0;$ii < $moduleRow->areas;$ii++){
    ?>
    <div class="col-12" dir="rtl" style="direction: rtl !important;">
        <label
            class="form-label"> <?php echo __('admin.' . $nms[$ii]); ?>

        </label>

        <div class="card">
            <div class="card-body">
                <div class="editor_ar" dir="rtl" style="direction: rtl !important;"
                     data-target="content_areas_ar{{$ii}}">{!!  old('area_ar.' .$ii)  !!}</div>
            </div>
        </div>
        <textarea hidden id="content_areas_ar{{$ii}}" name="area_ar[]" cols="20"
                  rows="2"></textarea>
    </div>
    <?php }}?>
@endif

@if($case== 'have_short_arabic')
    <div class="col-12"
         @if ($moduleRow->title == 'videos' || $moduleRow->title == 'video') hidden @endif>
        <label for="details"
               class="col-sm-2 col-form-label">{{ __('admin.short') }}</label>

        <div class="card">
            <div class="card-body">
                <div class="editor_ar"
                     data-target="have_short{{$moduleRow->id}}">{!! old('short_ar') !!} </div>
            </div>
        </div>


        <div class="col-sm-10 d-none">
                                        <textarea id="have_short{{$moduleRow->id}}"
                                                  name="short_ar">{!!  old('short_ar')!!}</textarea>
        </div>
    </div>
@endif

@if($case=='have_details_arabic')
    <div class="col-12"
         @if ($moduleRow->title == 'videos' || $moduleRow->title == 'video') hidden @endif>
        <label for="details"
               class="col-sm-2 col-form-label">{{ __('admin.details') }}</label>

        <div class="card">
            <div class="card-body">
                <div class="editor_ar"
                     data-target="details_ar{{$moduleRow->id}}">{!! old('details_ar')  !!}</div>
            </div>
        </div>


        <div class="col-sm-10 d-none">
                                        <textarea id="details_ar{{$moduleRow->id}}"
                                                  name="details_ar">{!! old('details_ar') !!}</textarea>
        </div>
    </div>
@endif

@if($case =='have_pic')
     <div class="col-md-6"
         @if ($moduleRow->title === 'videos'  || $moduleRow->title   == 'video') hidden @endif>
        <label for="file"
               class="form-label">{{ __('admin.image') }}</label>

        {{-- <input name="file" value="" type="hidden" /> --}}
        <input type="file" name="pic"
               class="form-control" id="customFile"
               @if ($moduleRow->pic_Req  == 'yes') required @endif />
        <font class="hint">
            @if ($moduleRow->pic_size)
                {{ $moduleRow->pic_size }}
            @else
                {{ __('admin.max_10') }}
            @endif
        </font>
    </div>
@endif

@if($case == 'texts_english')
    <?php if($moduleRow->txts > 0){
    $nms = explode(',', $moduleRow->txts_names);
    for($ii = 0;$ii < $moduleRow->txts;$ii++){
    ?>
    <div class="col-md-6">
        <label class="form-label label_{{$ii}}">
            @if ($nms[$ii] != 'add_date')
                {{ __("admin." . $nms[$ii])  }}
            @else
                {{ __('admin.date') }}
            @endif
        </label>

        @if ($nms[$ii] != 'add_date')
            <input type="text" name="txt[]"
                   class="form-control" value=""/>
        @elseif($nms[$ii] == 'Youtube Video Link')
            <input name="txt[0]" type="text" class="form-control"
                   style="text-align: left !important;" value=""/>
        @else
            <input name="txt[0]" type="date" class="form-control"
                   value="{{ date('Y/m/d') }}"/>
        @endif

    </div>
    <?php }}?>
@endif
@if($case == 'areas_english')

    <?php
    if($moduleRow->areas > 0){

    $nms = explode(',', $moduleRow->areas_names);

    for($ii = 0;$ii < $moduleRow->areas;$ii++){

    $area_name = 'area' . $ii;

    ?>
    <div class="col-md-12">
        <label
            class="form-label"> <?php echo __( 'admin.' . $nms[$ii]); ?>
        </label>

        <div class="card">
            <div class="card-body">
                <div class="editor"
                     data-target="extra_areas{{ $nms[$ii]}}">{!! old($area_name) !!}</div>
            </div>
        </div>

        {{--                                <?php if($moduleRow->title == 'equipment' || $moduleRow->title == 'workshop' ){?>--}}
        {{--                                <div class="span10"><input type="text" name="<?php echo $area_name; ?>">--}}
        {{--                                </div>--}}

        {{--                                <?php }else{ ?>--}}
        <textarea hidden id="extra_areas{{ $nms[$ii]}}" name="area[]"
                  cols="20"
                  rows="2"><?php echo old($area_name); ?></textarea>
        <!--                                --><?php //} ?>


    </div>

    <?php }}?>

@endif
@if($case == 'have_short_english')
    <div class="col-12">
        <label for="details" class="form-label">
            {{-- @if (Request::segment(3) == 'videos' || Request::segment(3) == 'video')
                {{ __('backend_lang/custom.embed_video') }}
            @else --}}
            {{ __('admin.short') }}
            {{-- @endif --}}
        </label>

        <div class="card">
            <div class="card-body">
                <div class="editor" data-target="short">{!! old('short') !!}</div>
            </div>
        </div>

        <textarea hidden id="short" name="short">{{old('short')}}</textarea>
    </div>

@endif
@if($case == 'have_details_english')

    <div class="col-12">
        <label for="details" class="col-sm-2 col-form-label">
            @if ($moduleRow->title == 'videos' || $moduleRow->title == 'video')
                {{ __('admin.embed_video') }}
            @else
                {{ __('admin.details') }}
            @endif
        </label>

        <div class="card">
            <div class="card-body">
                <div class="editor"
                     data-target="details_id">{!! old('details') !!}</div>
            </div>
        </div>
        <div class="col-sm-10">
                                            <textarea hidden id="details_id"
                                                      name="details">{{old('details')}}</textarea>
        </div>
    </div>

@endif
@if($case == 'more_fields')
    @isset($fields)
        <div class="col-md-6">
            @foreach ($fields as $fieldName => $fieldValues)
                <div class="col-sm-2">
                    <label
                        class="form-label text-capitalize">
                        {{ $fieldName }}
                        <input type="hidden"
                               name="fields[{{ $fieldName }}][name]"
                               value="{{ $fieldName }}">
                    </label>
                </div>
                <div class="col-sm-10">
                    @foreach ($fieldValues as $value)
                        @php
                            $count++;
                            $field = $moduleRow->moreFields
                                ->where('fieldName', $fieldName)
                                ->first();
                            $fType = $field ? $field->fType : null;
                            $morid = $field ? $field->id : null;
                        @endphp

                        @if ($fType == 'checkbox' || $fType == 'radio' || $fType == 'dropdown')
                            <div class="form-check form-check-inline">
                                <input type="checkbox"
                                       name="morefield{{ $morid }}[]"
                                       class="form-check-input"
                                       value="{{ $value }}"
                                       id="chk{{ $count }}">
                                <label class="form-check-label"
                                       for="chk{{ $count }}">{{ $value }}</label>
                            </div>
                        @endif

                        @if ($fType == 'textbox')
                            <input type="text"
                                   name="morefield{{ $morid }}"
                                   class="form-control" value=""
                                   id="inputPassword">
                        @endif
                        @if ($fType == 'fileupload')
                            <input name="morefield{{ $morid }}_2"
                                   value="" type="hidden"/>
                            <input type="file"
                                   name="morefield{{ $morid }}"
                                   class="form-control" id="customFile"/>
                            <font class="hint">
                                max size is 10 mb
                            </font>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>
    @endisset

@endif
