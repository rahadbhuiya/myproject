@extends('web.layouts.app')
@section('title', 'Home')
@section('description', 'Playhost - Game Hosting Website Template')
@section('content')

        
        <!-- content begin -->
        <div class="no-bottom no-top" id="content">

            <div id="top"></div>

            <section class="jarallax">
                <img src="{{asset('fontend/images/background/bg1.jpg')}}" class="jarallax-img" alt="">                
                <div class="de-gradient-edge-bottom"></div>



                <div id="slider-carousel" class="owl-carousel owl-theme">



                    @foreach($banners as $banner)
                        <div class="slider-item">
                            <div class="container">
                                <div class="row gx-5 align-items-center">
                                    <div class="col-lg-6 mb-sm-30">
                                        <div class="subtitle blink mb-4">{{ $banner->cta_button_text }}</div>
                                        <h1 class="slider-title text-uppercase mb-1">{{ $banner->hero_title }}</h1>
                                        <p class="slider-text">{{ $banner->hero_subtitle }}</p>
                                        <div class="row">
                                            <div class="col-lg-6"></div>
                                        </div>
                                        <div class="sw-price">
                                            <div class="d-starting">
                                                Starting at
                                            </div>
                                            <div class="d-price">
                                                <span class="d-cur">BDT</span>
                                                <span class="d-val">{{ $banner->price }}</span>
                                                <span class="d-period">/monthly</span>
                                            </div>
                                        </div>
                                        <div class="spacer-10"></div>
                                        <a class="btn-main mb10" href="#"><span>Explore More</span></a>
                                    </div>
                                    <div class="col-lg-6">
                                        <img src="{{ asset($banner->hero_image) }}" class="img-fluid rounded-20" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                    
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

            {{-- <section class="no-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="subtitle wow fadeInUp mb-3">Testimonials</div>
                            <h2 class="wow fadeInUp mb20" data-wow-delay=".2s">What They Says</h2>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="de-testi-a rounded-20 bg-dark-2 overflow-hidden s2 h-100 jarallax">
                                <img src="{{asset('fontend/images/background/4.webp')}}" class="jarallax-img" alt="">
                                <div class="d-quote wow fadeInUp">
                                    <div class="de-rating-ext mb-3">
                                        <span class="d-stars">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </span>
                                    </div>
                                    <p>Their servers are lightning-fast, and their customer support is top-notch. I highly recommend them to any gamer looking for a premium hosting experience.</p>
                                </div>
                                <div class="d-by">
                                    <div class="d-name id-color">Lucas Thompson</div>
                                    <div class="d-info">Enthusiast Gamer</div>
                                </div>
                                <img src="{{asset('fontend/images/clients/1.webp')}}" class="d-img wow fadeInUp" data-wow-delay=".3s" alt="">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="de-testi-a rounded-20 bg-dark-2 overflow-hidden s2 h-100 jarallax">
                                <img src="{{asset('fontend/images/background/4.webp')}}" class="jarallax-img" alt="">
                                <div class="d-quote wow fadeInUp">
                                    <div class="de-rating-ext mb-3">
                                        <span class="d-stars">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </span>
                                    </div>
                                    <p>Their intuitive control panel guided me through every step of setting up and managing my server, and their extensive knowledge base provided answers to all of my questions.</p>
                                </div>
                                <div class="d-by">
                                    <div class="d-name id-color">Olivia Parker</div>
                                    <div class="d-info">Enthusiast Gamer</div>
                                </div>
                                <img src="{{asset('fontend/images/clients/2.webp')}}" class="d-img wow fadeInUp" data-wow-delay=".3s" alt="">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="de-testi-a rounded-20 bg-dark-2 overflow-hidden s2 h-100 jarallax">
                                <img src="{{asset('fontend/images/background/4.webp')}}" class="jarallax-img" alt="">
                                <div class="d-quote wow fadeInUp">
                                    <div class="de-rating-ext mb-3">
                                        <span class="d-stars">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </span>
                                    </div>
                                    <p>Their automated backup system has saved me from countless headaches, ensuring that my players' progress is always protected. Plus, their integrated voice chat. </p>
                                </div>
                                <div class="d-by">
                                    <div class="d-name id-color">Ethan Rodriguez</div>
                                    <div class="d-info">Enthusiast Gamer</div>
                                </div>
                                <img src="{{asset('fontend/images/clients/3.webp')}}" class="d-img wow fadeInUp" data-wow-delay=".3s" alt="">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="de-testi-a rounded-20 bg-dark-2 overflow-hidden s2 h-100 jarallax">
                                <img src="{{asset('fontend/images/background/4.webp')}}" class="jarallax-img" alt="">
                                <div class="d-quote wow fadeInUp">
                                    <div class="de-rating-ext mb-3">
                                        <span class="d-stars">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </span>
                                    </div>
                                    <p>The automated mod installation feature has made it incredibly easy to customize our servers, and their competitive pricing plans fit perfectly within our budget. </p>
                                </div>
                                <div class="d-by">
                                    <div class="d-name id-color">Emily Patel</div>
                                    <div class="d-info">Enthusiast Gamer</div>
                                </div>
                                <img src="{{asset('fontend/images/clients/4.webp')}}" class="d-img wow fadeInUp" data-wow-delay=".3s" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </section> --}}

<section class="jarallax position-relative">
    <img src="{{ asset('fontend/images/background/bg2.jpg') }}" class="jarallax-img" alt="">
    <div class="de-gradient-edge-top"></div>
    <div class="de-gradient-edge-bottom"></div>
    <div class="container position-relative z-1000">
        <div class="row align-items-center mb-4">
            <div class="col-lg-6">
                <div class="subtitle wow fadeInUp mb-3">Top Up</div>
                <h2 class="wow fadeInUp mb-4" data-wow-delay=".2s">TopUp Your Game</h2>
            </div>
            <div class="col-lg-6 text-lg-end">
                <a class="btn btn-primary mb-sm-30" href="game-server-1.html">
                    <span>View all</span>
                </a>
            </div>
        </div>

        <div class="row g-4">
            @foreach($categorys as $category)
            <div class="col-lg-3 col-md-6 gallery-item">
                <div class="de-item wow" style="height: 290px;">
                    <div class="d-overlay">
                        <div class="d-text">
                            <a class="btn-main mb10" href="{{ route('category.games', $category->id) }}">
                                
                                <span style="color: #fff;">View  {{ $category->name }}</span>
                            </a>
                        </div>
                    </div>
                    <a href="{{ route('category.games', $category->id) }}">
                        <img src="{{ asset($category->image) }}" class="img-fluid" alt="{{ $category->name }}">
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>             

            {{-- <section class="no-top no-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">                            
                            <div class="subtitle wow fadeInUp mb-3">Do you have</div>
                            <h2 class="wow fadeInUp mb20" data-wow-delay=".2s">Any questions?</h2>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-lg-6">
                            <div class="accordion s2 wow fadeInUp">
                                <div class="accordion-section">
                                    <div class="accordion-section-title s2" data-tab="#accordion-a1">
                                        What is game hosting?
                                    </div>
                                    <div class="accordion-section-content" id="accordion-a1">
                                        <p>Game hosting refers to the process of renting or setting up servers to run multiplayer online games. These servers allow players to connect and play together in the same game world.</p>
                                    </div>
                                    <div class="accordion-section-title s2" data-tab="#accordion-a2">
                                        Why do I need game hosting?
                                    </div>
                                    <div class="accordion-section-content" id="accordion-a2">
                                        <p>Game hosting is essential for multiplayer gaming. It provides a dedicated server where players can join, ensuring a smooth and lag-free gaming experience. It also allows you to customize game settings and mods.</p>
                                    </div>                                        
                                    <div class="accordion-section-title s2" data-tab="#accordion-a3">
                                        How do I choose a game hosting provider?
                                    </div>
                                    <div class="accordion-section-content" id="accordion-a3">
                                        <p>Consider factors like server location, performance, scalability, customer support, and price when choosing a game hosting provider. Read reviews and ask for recommendations from fellow gamers.</p>
                                    </div>
                                    <div class="accordion-section-title s2" data-tab="#accordion-a4">
                                        What types of games can I host?
                                    </div>
                                    <div class="accordion-section-content" id="accordion-a4">
                                        <p>You can host various types of games, including first-person shooters, role-playing games, survival games, strategy games, and more. The type of game hosting you need depends on the game's requirements.</p>
                                    </div>
                                    <div class="accordion-section-title s2" data-tab="#accordion-a5">
                                        What is server latency or ping?
                                    </div>
                                    <div class="accordion-section-content" id="accordion-a5">
                                        <p>Server latency or ping measures the time it takes for data to travel between your computer and the game server. Lower ping values indicate better responsiveness and less lag.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="accordion s2 wow fadeInUp">
                                <div class="accordion-section">
                                    <div class="accordion-section-title s2" data-tab="#accordion-b1">
                                        How do I manage a game server?
                                    </div>
                                    <div class="accordion-section-content" id="accordion-b1">
                                        <p>Game server management varies depending on the hosting provider and game type. Typically, you'll have access to a control panel or command-line interface to configure settings, mods, and player access.</p>
                                    </div>
                                    <div class="accordion-section-title s2" data-tab="#accordion-b2">
                                        Can I run mods on my game server?
                                    </div>
                                    <div class="accordion-section-content" id="accordion-b2">
                                        <p>Yes, many game hosting providers support mods. You can install and manage mods to enhance gameplay or customize the game to your liking.</p>
                                    </div>
                                    <div class="accordion-section-title s2" data-tab="#accordion-b3">
                                        What is DDoS protection, and do I need it?
                                    </div>
                                    <div class="accordion-section-content" id="accordion-b3">
                                        <p>DDoS (Distributed Denial of Service) protection helps defend your game server from malicious attacks that could disrupt gameplay. It's essential for maintaining server stability, especially for popular games.</p>
                                    </div>
                                    <div class="accordion-section-title s2" data-tab="#accordion-b4">
                                        How much does game hosting cost?
                                    </div>
                                    <div class="accordion-section-content" id="accordion-b4">
                                        <p>Game hosting costs vary depending on the provider, server type, and game. Prices can range from a few dollars per month for small servers to hundreds for high-performance dedicated servers.</p>
                                    </div>
                                    <div class="accordion-section-title s2" data-tab="#accordion-b5">
                                        Is there 24/7 customer support?
                                    </div>
                                    <div class="accordion-section-content" id="accordion-b5">
                                        <p>Many reputable game hosting providers offer 24/7 customer support to assist with technical issues and server management.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section> --}}

            <section>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-4">
                            <div class="subtitle wow fadeInUp mb-3">Payment Methods</div>
                            <h2 class="wow fadeInUp" data-wow-delay=".2s">We accept</h2>
                        </div>
                        <div class="col-lg-8 wow fadeInRight">
                            <div class="row g-4">
                                <div class="col-sm-2 col-4">
                                    <div class="p-2 rounded-10" data-bgcolor="rgba(255, 255, 255, .05)">
                                        <img src="{{asset('fontend/images/payments/visa.webp')}}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-2 col-4">
                                    <div class="p-2 rounded-10" data-bgcolor="rgba(255, 255, 255, .05)">
                                        <img src="{{asset('fontend/images/payments/mastercard.webp')}}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-2 col-4">
                                    <div class="p-2 rounded-10" data-bgcolor="rgba(255, 255, 255, .05)">
                                        <img src="{{asset('fontend/images/payments/paypal.webp')}}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-2 col-4">
                                    <div class="p-2 rounded-10" data-bgcolor="rgba(255, 255, 255, .05)">
                                        <img src="{{asset('fontend/images/payments/bikash.svg')}}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-2 col-4">
                                    <div class="p-1 rounded-10" data-bgcolor="rgba(255, 255, 255, .05)">
                                        <img src="{{asset('fontend/images/payments/roket3.png')}}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-2 col-4">
                                    <div class="p-2 rounded-10" data-bgcolor="rgba(255, 255, 255, .05)">
                                        <img src="{{asset('fontend/images/payments/nogod.png')}}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-2 col-4">
                                    <div class="p-2 rounded-10" data-bgcolor="rgba(255, 255, 255, .05)">
                                        <img src="{{asset('fontend/images/payments/american-express.webp')}}" class="img-fluid" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        </div>
        <!-- content close -->
        
       
        <!-- footer close -->
    </div>
    


@endsection