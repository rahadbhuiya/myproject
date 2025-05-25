@extends('admin.layouts.admin')
@section('title', 'Banner')
@section('content')

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Create New Banner</div>
                    <hr>

                    <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Column 1 -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="hero_title">Hero Title</label>
                                    <input type="text" class="form-control form-control-rounded" id="hero_title" name="hero_title" placeholder="Enter Hero Title">
                                </div>
                                <div class="form-group">
                                    <label for="hero_subtitle">Hero Subtitle</label>
                                    <input type="text" class="form-control form-control-rounded" id="hero_subtitle" name="hero_subtitle" placeholder="Enter Hero Subtitle">
                                </div>
                            </div>

                            

                            <!-- Column 3 -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cta_button_text">Short Tittle</label>
                                    <input type="text" class="form-control form-control-rounded" id="cta_button_text" name="cta_button_text" placeholder="Enter CTA Button Text">
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control form-control-rounded" id="price" name="price" placeholder="Enter Price">
                                </div>
                            </div>

                            <!-- Column 2 -->
                            <div class="col-md-4">
                                
                                
                                <div class="form-group">
                                    <label for="hero_image">Hero Image</label>
                                    <input type="file" class="form-control form-control-rounded" id="hero_image" name="hero_image">
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group text-center mt-3">
                            <button type="submit" class="btn btn-light btn-round px-5">
                                <i class="icon-lock"></i> Save Banner
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection