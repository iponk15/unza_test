<div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
    <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">

            <!--begin::Page Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ $pagetitle }}</h5>
            <!--end::Page Title-->

            <!--begin::Actions-->
            @if(!empty($breadcrumb))
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    @foreach($breadcrumb as $text => $url)
                        <li class="breadcrumb-item">
                            <a href="{{ $url }}" class="text-muted ajaxify" {!! (empty($url) ? 'style="pointer-events: none;"' : '' ) !!} >{{ $text }}</a>
                        </li>
                    @endforeach
                </ul>
            @endif
            <!--end::Actions-->
        </div>
        <!--end::Info-->

        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            @if(!empty($subHeadBtn))
                {!! $subHeadBtn !!}
            @endif
        </div>
        <!--end::Toolbar-->
    </div>
</div>