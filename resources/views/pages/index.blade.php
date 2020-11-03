@extends('pages.layouts.app')

@section('content')
  <!-- Page Header -->
  <header class="masthead" style="background-image: url('{{ asset('img/bird.jpg') }}')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Birds Blog</h1>
            <span class="subheading">Pusatnya ilmu pengetahuan tentang merawat dan budi daya burung.</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        @foreach ($articles as $item)
          <div class="post-preview">
            <a href="{{ route('page.read', ['slug' => $item->slug]) }}">
              <h2 class="post-title">
                {{ $item->title }}
              </h2>
            </a>
            <p class="post-meta">Posted by
              <a href="#">{{ $item->author }}</a>
              on {{ $item->getArticleTimezone('created_at', 'd M Y') }}</p>
          </div>
          <hr>
        @endforeach
        <!-- Pager -->
        <div class="clearfix">
          {{-- <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a> --}}
        </div>
      </div>
    </div>
  </div>
@endsection