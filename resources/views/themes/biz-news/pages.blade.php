@extends('themes.biz-news.layouts.main')
@section('main')
<!-- Pages Start -->
<div class="container-fluid mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h4 class="m-0 text-uppercase font-weight-bold">{{ $page->title}}</h4>
                </div>
            </div>
            <div class="col-lg-8">
                <!-- Pages Detail Start -->
                <div class="position-relative mb-3">
                    <div class="bg-white border border-top-0 p-4">
                        {!! $page->content !!}
                    </div>
                </div>
                <!-- Pages Detail End -->

            </div>

            @include('themes.biz-news.layouts.sidebar')
        </div>
    </div>
</div>
<!-- Pages End -->
@endsection