@if ($data->module != 'video' && $data->module != 'videos' )

    <div class="col-md-6">
        <label for="enname"
               class="form-label">{{ __('backend_lang/custom.image') }}</label>

        @if ($data->pic)
            <div class="row">
                <div
                    class="col-lg-2 col-sm-3">
                    @if (asset(  $data->pic))
                        {{-- <a href="" class="fancybox"
                        data-bs-toggle="modal"
                        data-bs-target="#exampleModal"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top">

                        <img class="img-thumbnail mt-2 mb-2"
                            src='{{ asset('uploads/posts/images/' . $data->pic) }}' />

                    </a> --}}

                        <div
                            class="popup-gallery">
                            <a href="{{ asset( $data->pic) }}" target="_blank"
                               title="">
                                <img
                                    src="{{ asset(  $data->pic) }}"
                                    class="img-fluid"
                                    style="height:85px; width:85px"
                                    alt=""/>
                            </a>
                        </div>
                    @endif
                </div>
                <div
                    class="col-lg-10 col-sm-9">
                    <input
                        name="pic" class="form-control"
                        value="{{ $data->pic }}"
                        type="hidden"/>
                    @if ($data->module != 'Programs' )
                        <input
                            type="file"
                            name="pic"
                            class="form-control"
                            id="customFile"/> @endif
                    <font
                        class="hint">
                        @if ($data->moduleRelation->pic_size)
                            {{ $data->moduleRelation->pic_size }}
                            ,
                        @else
                            {{ __('backend_lang/custom.max_10') }}
                        @endif
                    </font>
                </div>
            </div>
        @else


            {{-- <input name="pic" value="{{ $data->pic }}"
            type="hidden" /> --}}
            <input
                type="file"
                name="pic"
                class="form-control"
                id="customFile"/>
            <font
                class="hint">
                {{ __('backend_lang/custom.max_10') }}
            </font>

        @endif


    </div>
@endif
