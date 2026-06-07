@extends('themes.biz-news.layouts.main')

@section('main')
<!-- Galleries Start -->
<div class="container-fluid mt-5 pt-3">
    <div class="container">
        <div class="row">

            <div class="col-12">
                <div class="section-title">
                    <h4 class="m-0 text-uppercase font-weight-bold">Galleries</h4>
                </div>
            </div>
            @foreach ($galleries as $item)
                <div class="col-lg-4">
                    <div class="position-relative mb-3">
                        <div style="height:225px; overflow:hidden;">
                            <img class="img-fluid w-100 h-100" src="{{ $item->image }}" style="object-fit: cover;">
                        </div>
                        <div class="bg-white border border-top-0 p-4">
                            <div class="mb-2">
                                <datetime><small>{{ $item->created_at->format('M Y') }}</small></datetime>
                            </div>
                            <a class="h6 d-block mb-0 text-secondary text-uppercase font-weight-bold" href="{{ route('gallery.detail', $item->slug) }}">{{ $item->name }}</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
<!-- Galleries End -->
@endsection
