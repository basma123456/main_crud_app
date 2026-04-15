@php
    $nms = explode(',', $data->moduleRelation->up_names);
@endphp

@for ($ii = 0; $ii < $data->moduleRelation->up; $ii++)
    <div class="col-md-6">
        <label
            class="form-label">
            @if ($nms[$ii] != 'date')
                {{ __('admin.' . $nms[$ii]) }}
            @else
                {{ __('admin.date') }}
            @endif
        </label>
        @php
            $fileVariable = 'up' . ($ii + 1);
        @endphp


        <div class="row">
            {{--                                                                {{dd($data->moduleRelation->title)}}--}}
            {{--{{dd($data )}}--}}
            @if (!empty($data->$fileVariable) && $data->$fileVariable != '0')
                <div
                    class="col-lg-2 col-sm-3">
                    <div
                        class="popup-gallery">
                        <a href="{{ asset(  $data->$fileVariable) }}"  target="_blank"
                           title="">
                            <img
                                src="{{ asset(  $data->$fileVariable) }}"
                                class="img-fluid"
                                style="height:85px; width:85px"
                                alt=""/>
                        </a>
                    </div>
                </div>

                <div
                    class="col-lg-10 col-sm-9 up">
                    <input
                        class="form-control"
                        name="upp{{ $ii }}"
                        value="{{ $data->$fileVariable }}"
                        type="hidden"/>

                    @if ($nms[$ii] == 'PDF File')
                        <font
                            class="hint">
                            {{ __('admin.max_10') }}
                            doc,docx,pdf,xlsx,pptx</font>
                        <a href="{{ asset(  $data->$fileVariable) }}"
                           target="_blank">
                                                                                <span
                                                                                    style="font-weight: bold !important;color: #34567C !important; font-size: 14px !important;">
                                                                                    <img
                                                                                        src="{{ asset('uploads/add_ex/down.png') }}"
                                                                                        width="30"
                                                                                        height="30"/>
                                                                                    {{ __('admin.show_file') }}
                                                                                </span>
                        </a>
                    @else

                        @if ($data->moduleRelation->title != 'join')
                            <input
                                class="form-control"
                                name="up{{ $ii }}"
                                type="file"/>
                            <font
                                class="hint">
                                {{ __('admin.max_10') }}
                                {{-- {{ __('admin.max_2') }} --}}
                                {{-- doc,docx,pdf,xlsx,pptx,
                                jpg,jpeg,png,gif --}}
                            </font>
                        @endif
                    @endif

                    @if ($nms[$ii] == 'PDF File')
                        @if ($type == 'slider')
                            <font
                                class="hint">
                                {{ __('admin.max_10') }}
                                doc,docx,pdf,xlsx</font>
                        @else
                            <font
                                class="hint">
                                {{ __('admin.max_10') }}
                                doc,docx,pdf</font>
                        @endif
                    @elseif($nms[$ii] == 'background')
                        <font
                            class="hint">
                            {{ __('admin.max_2') }}
                            Best
                            Size
                            960*300
                            jpg,jpeg,png,gif</font>
                    @endif
                </div>
            @else
                @if ($data->moduleRelation->title != 'join')
                    <input
                        class="form-control"
                        name="up{{ $ii }}"
                        type="file"/>
                    <font
                        class="hint">
                        {{ __('admin.max_2') }}
                        doc,docx,pdf,xlsx,pptx,
                        jpg,jpeg,png,gif
                    </font>
                @endif
            @endif

        </div>

    </div>
@endfor
