@php
    $count = 0;
@endphp

<div class="row pt-3">
    {{-- @if ($unserializedData) --}}
    @foreach ($fields as $fieldName => $fieldValues)

        <label
            class="form-label text-capitalize">
            {{ $fieldName }}
        </label>

        <div class="col-md-6">
            @foreach ($fieldValues as $value)
                @php
                    $count++;
                    $field = $morefields_data
                        ->where('fieldName', $fieldName)
                        ->first();
                    $fType = $field ? $field->fType : null;
                    $morid = $field ? $field->id : null;
                    // get current post morefield value
                    // $data10 = $post_more_field_value = App\Models\admin\PostsMoreFields::where('field_name', $fieldName)
                    $post_more_field_value = App\Models\PostsMoreFields::where(
                        'field_name',
                        $fieldName,
                    )
                        ->where('post_id', $data->id)
                        ->value('field_value');
                @endphp


                {{-- @if ($fType == 'checkbox' || $fType == 'radio' || $fType == 'dropdown')
                    @php

                        //  $unserializedData2 = [];
                        /* print_r( */ $unserializedData2 = unserialize($post_more_field_value) /* ) */
                        if (!$unserializedData2) {
                            echo $unserializedData2 = $post_more_field_value;
                            // dd();
                        }
                    @endphp


                    <div class="form-check form-check-inline">
                        <input type="checkbox"
                            {{ in_array($value, $unserializedData2) ? 'checked' : '' }}
                            name="morefield{{ $morid }}[]"
                            class="form-check-input"
                            value="{{ $value }}"
                            id="chk{{ $count }}">
                        <label class="form-check-label"
                            for="chk{{ $count }}">{{ $value }}</label>
                    </div>
                @endif --}}

                @if ($fType == 'checkbox' || $fType == 'radio' || $fType == 'dropdown')
                    @php
                        $unserializedData2 = unserialize(
                            $post_more_field_value,
                        );

                        if (!is_array($unserializedData2)) {
                            $unserializedData2 = [$unserializedData2];
                        }
                    @endphp




                    {{--                                                                <div class="col-md-4 d-flex align-items-center">--}}
                    {{--                                                                    <div class="form-check form-switch">--}}
                    {{--                                                                        <input class="form-check-input" type="checkbox" id="publishSwitch">--}}
                    {{--                                                                        <label class="form-check-label ms-2" for="publishSwitch">نشر الخبر / المقال</label>--}}
                    {{--                                                                    </div>--}}
                    {{--                                                                </div>--}}



                    <div
                        class="form-check form-check-inline">
                        <input
                            type="checkbox"
                            {{ in_array($value, $unserializedData2) ? 'checked' : '' }}
                            name="morefield{{ $morid }}[]"
                            class="form-check-input"
                            value="{{ $value }}"
                            id="chk{{ $count }}">
                        <label
                            class="form-check-label"
                            for="chk{{ $count }}">{{ $value }}</label>
                    </div>
                @endif

                @if ($fType == 'textbox')
                    <input type="text"
                           name="morefield{{ $morid }}"
                           class="form-control"
                           value="{{ $post_more_field_value }}"
                           id="inputPassword">
                @endif
                @if ($fType == 'fileupload')
                    <div class="row">
                        @if ($post_more_field_value)
                            <div
                                class="col-sm-2">
                                @if (asset('uploads/posts/images/' . $post_more_field_value))
                                    <a href=""
                                       class="fancybox"
                                       data-bs-toggle="modal"
                                       data-bs-target="#exampleModal2"
                                       data-bs-toggle="tooltip"
                                       data-bs-placement="top">

                                        <img
                                            class="img-thumbnail mt-2 mb-2"
                                            src='{{ asset('uploads/posts/images/' . $post_more_field_value) }}'/>

                                    </a>
                                    {{-- popoup modal --}}
                                    <div
                                        class="modal fade"
                                        id="exampleModal2"
                                        tabindex="-1"
                                        aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div
                                            class="modal-dialog">
                                            <div
                                                class="modal-content">
                                                <div
                                                    class="modal-body">
                                                    <img
                                                        class="img-fluid rounded"
                                                        src='{{ asset('uploads/posts/images/' . $post_more_field_value) }}'/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- popoup modal --}}
                                @endif
                            </div>
                        @endif
                        {{-- @else --}}
                        <div
                            class="col-sm-@if ($post_more_field_value) 10 @else 12 @endif pt-3">

                            <input
                                name="morefield{{ $morid }}_2"
                                value="{{ $post_more_field_value }}"
                                type="hidden"/>
                            <input
                                type="file"
                                name="morefield{{ $morid }}"
                                class="form-control"
                                id="customFile"/>
                            <font
                                class="hint">
                                {{ __('admin.max_10') }}
                            </font>
                        </div>
                    </div>
                    {{-- @endif --}}
                @endif
                {{-- @if ($fType == 'fileupload')
                    <input name="morefield{{ $morid }}_2"
                        value="" type="hidden" />
                    <input type="file"
                        name="morefield{{ $morid }}"
                        class="form-control" id="customFile" />
                    <font class="hint">
                        {{ __('admin.max_10') }}
                    </font>
                @endif --}}
            @endforeach
        </div>
    @endforeach
    {{-- @endif --}}
</div>

