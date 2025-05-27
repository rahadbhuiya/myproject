@extends('web.layouts.app')
@section('content')

<!-- content begin -->
<div class="no-bottom no-top" id="content">
    <div id="top"></div>

    <!-- Subheader Section -->
    <section id="subheader" class="jarallax position-relative">
        <div class="de-gradient-edge-bottom"></div>
        <img src="{{ asset('fontend/images/background/subheader-game.webp') }}" class="jarallax-img" alt="Subheader Background">

        <div class="container z-1000">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-2 d-none d-lg-block">
                    <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="img-fluid wow fadeInUp">
                </div>
                <div class="col-lg-6">
                    <h2 class="wow fadeInUp mb-20" data-wow-delay=".2s">{{ $category->name }}</h2>
                    <p class="wow fadeInUp" data-wow-delay=".3s">{{ $category->description }}</p>
                    <div class="de-rating-ext wow fadeInUp" data-wow-delay=".4s" aria-label="Ratings">
                        <span class="d-stars" aria-hidden="true">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half"></i>
                        </span>
                        <span class="d-val">4.75</span>
                        based on <strong>4086</strong> reviews.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Top Up Products Section -->
    <section class="jarallax position-relative">
        <img src="{{ asset('fontend/images/background/bg2.jpg') }}" class="jarallax-img" alt="Background Image">
        <div class="de-gradient-edge-top"></div>
        <div class="de-gradient-edge-bottom"></div>

        <div class="container position-relative z-1000">
            <div class="row align-items-center mb-4">
                <div class="col-lg-6">
                    <div class="subtitle wow fadeInUp mb-3">Top Up</div>
                    <h2 class="wow fadeInUp mb-4" data-wow-delay=".2s">TopUp {{ $category->name }}</h2>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <a href="#" class="btn btn-primary mb-sm-30"><span>View all</span></a>
                </div>
            </div>

            <div class="row g-4">
                @forelse($products as $product)
                    <div class="col-lg-3 col-md-6 gallery-item">
                        <div class="de-item wow" style="height: 290px;">
                            <div class="d-overlay">
                                <div class="d-text">
                                    <a href="{{ route('order.create', $product->id) }}" class="btn-main mb-10" aria-label="Buy {{ $product->name }}">
                                        <span style="color: #fff;">Buy {{ $product->product_name }}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="spacer-10"></div>
                            <a href="{{ route('game.products', $product->game->id) }}">
                                <img src="{{ asset($product->game->logo) }}" alt="{{ $product->game->name }}" class="img-fluid" style="height: 290px; object-fit: cover;">
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center text-white">No products found under this category.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="no-top no-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="subtitle wow fadeInUp mb-3">Features</div>
                    <h2 class="wow fadeInUp mb-20" data-wow-delay=".2s">Premium Service 💱 Money Exchange</h2>
                    <p class="mb-0">Easily exchange popular currencies like USD, EUR, GBP, JPY, INR, and BDT with fast, secure, and reliable service.</p>
                    <a href="{{ route('exchange-rates.index') }}" class="btn-main mb-10 mt-4"><span>Exchange Now</span></a>
                </div>
            </div>

            <div class="row g-4 my-4">
                @foreach ($features as $feature)
                    <div class="col-lg-3 col-md-6 mb-sm-20 wow fadeInRight" data-wow-delay="0s">
                        <div class="padding40 rounded-20 bg-dark-2 h-100 jarallax">
                            {{-- Uncomment and replace with image if needed --}}
                            {{-- <img src="{{ asset('fontend/images/background/4.webp') }}" class="jarallax-img" alt="{{ $feature->title }}"> --}}
                            <h4>{{ $feature->title }}</h4>
                            <p class="mb-0">{{ $feature->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

</div>
<!-- content close -->
@endsection
