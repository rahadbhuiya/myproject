@extends('web.layouts.app')
@section('content')







<!-- content begin -->
        <div class="no-bottom no-top" id="content">
            <div id="top"></div>

            <section id="subheader" class="jarallax">
                <div class="de-gradient-edge-bottom"></div>
                <img src="{{asset('fontend/images/background/subheader-game.webp')}}" class="jarallax-img" alt="">
                <div class="container z-1000">
                    <div class="row gx-5 align-items-center">
                        <div class="col-lg-2 d-lg-block d-none">
                            <img src="{{$category->image}}" class="img-fluid wow fadeInUp" alt="">
                        </div>
                        <div class="col-lg-6">
                            
                            <h2 class="wow fadeInUp mb20" data-wow-delay=".2s">{{$category->name}}</h2>
                            <p class="wow fadeInUp" data-wow-delay=".3s">{{ $category->description }}</p>
                            <div class="de-rating-ext wow fadeInUp" data-wow-delay=".4s">
                                <span class="d-stars">
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
            



            

<section class="jarallax position-relative">
    <img src="{{ asset('fontend/images/background/bg2.jpg') }}" class="jarallax-img" alt="">
    <div class="de-gradient-edge-top"></div>
    <div class="de-gradient-edge-bottom"></div>

    <div class="container position-relative z-1000">
        <div class="row align-items-center mb-4">
            <div class="col-lg-6">
                <div class="subtitle wow fadeInUp mb-3">Top Up</div>
                <h2 class="wow fadeInUp mb-4" data-wow-delay=".2s">TopUp {{ $category->name }}</h2>
            </div>
            <div class="col-lg-6 text-lg-end">
                <a class="btn btn-primary mb-sm-30" href="#"><span>View all</span></a>
            </div>
        </div>

        <div class="row g-4">
            @forelse($category->games as $game)
                <div class="col-lg-3 col-md-6 gallery-item">
                    <div class="de-item wow" style="height: 290px;">
                        <div class="d-overlay">
                            <div class="d-text">
                                <a class="btn-main mb10" href="{{ route('game.products', $game->id) }}">
                                   
                                    <span style="color: #fff;">buy {{ $game->name }}</span>
                                </a>
                            </div>
                        </div>
                        <div class="spacer-10"></div>
                        <a  href="{{ route('game.products', $game->id) }}">
                            <img  src="{{ asset($game->logo) }}" class="img-fluid" alt="{{ $game->name }}" style="height: 290px; object-fit: cover;">
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-white">No games found under this category.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>




                    <section class="no-top no-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="subtitle wow fadeInUp mb-3">Features</div>
                            <h2 class="wow fadeInUp mb20" data-wow-delay=".2s">Premium Service 💱 Money Exchange</h2>
                            <p class="mb-0">Easily exchange popular currencies like USD, EUR, GBP, JPY, INR, and BDT with fast, secure, and reliable service.</p>
                            <a class="btn-main mb10 mt-4" href="{{ route('exchange-rates.index') }}"><span>Exchange Now</span></a>
                        </div>
                    </div>

                    


                    <div class="row g-4 my-4">
                        @foreach ($features as $feature)
                            <div class="col-lg-3 col-md-6 mb-sm-20 wow fadeInRight" data-wow-delay="0s">
                                <div class="padding40 rounded-20 bg-dark-2 h-100 jarallax">
                                    {{-- <img src="{{ asset('fontend/images/background/4.webp') }}" class="jarallax-img" alt=""> --}}
                                    <h4>{{ $feature->title }}</h4>
                                    <p class="mb-0">{{ $feature->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                </div>
            </section>
        <!-- content close -->



@endsection