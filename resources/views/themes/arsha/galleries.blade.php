@extends('themes.arsha.layouts.main')

@section('main')
<main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="container">
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Galleries</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Galleries Section -->
    <section id="portfolio" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Gallery</h2>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

            @foreach ($galleries as $item)
                
            <div class="col-md-4 portfolio-item isotope-item" style="height:220px; overflow:hidden;">
              <img src="{{ $item->image }}" class="img-fluid" alt="{{ $item->name }}" style="object-fit: cover;">
              <div class="portfolio-info">
                <a href="{{ route('gallery.detail', $item->slug) }}"><h4>{{ $item->name }}</h4></a>
                <a href="{{ route('gallery.detail', $item->slug) }}" title="{{ $item->name }} Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div><!-- End Galleries Item -->
            @endforeach

          </div><!-- End Galleries Container -->

        </div>

      </div>

    </section><!-- /Galleries Section -->

</main>
@endsection