@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('content') 

<!--Start Dashboard Content-->
<div class="card mt-3">
    <div class="card-content">
        <div class="row row-group m-0">
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0">{{ $totalOrders }} <span class="float-right"><i class="fa fa-shopping-cart"></i></span></h5>
                  <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                  </div>
                  <p class="mb-0 text-white small-font">Total Orders</p>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0">{{ $totalGames }} <span class="float-right"><i class="fa fa-gamepad"></i></span></h5>
                  <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                  </div>
                  <p class="mb-0 text-white small-font">Total Games</p>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0">{{ $totalCategories }} <span class="float-right"><i class="fa fa-th-large"></i></span></h5>
                  <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                  </div>
                  <p class="mb-0 text-white small-font">Categories</p>
                </div>
            </div>
            <!-- <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0">{{ $exchangeRate->rate ?? 'N/A' }} <span class="float-right"><i class="fa fa-money"></i></span></h5>
                  <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                  </div>
                  <p class="mb-0 text-white small-font">Exchange Rate (BDT)</p>
                </div>
            </div> -->
        </div>
    </div>
</div>
@endsection