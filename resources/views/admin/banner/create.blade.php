@extends('admin.layouts.admin')
@section('title', 'Create Banner')
@section('content')

<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Create New Banner</div>
                <hr>

                <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- First Column (33%) -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="hero_title">Hero Title</label>
                                <input type="text" name="hero_title" id="hero_title" class="form-control" placeholder="Enter Hero Title" required value="{{ old('hero_title') }}">
                                @error('hero_title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="hero_subtitle">Hero Subtitle</label>
                                <input type="text" name="hero_subtitle" id="hero_subtitle" class="form-control" placeholder="Enter Hero Subtitle" required value="{{ old('hero_subtitle') }}">
                                @error('hero_subtitle')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Second Column (33%) -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cta_button_text">Short Title</label>
                                <input type="text" name="cta_button_text" id="cta_button_text" class="form-control" placeholder="Enter Short Title" required value="{{ old('cta_button_text') }}">
                                @error('cta_button_text')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="price">Price</label>
                                <input type="text" name="price" id="price" class="form-control" placeholder="Enter Price" required value="{{ old('price') }}">
                                @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Third Column (33%) -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="hero_image">Hero Image</label>
                                <input type="file" name="hero_image" id="hero_image" class="form-control" required>
                                @error('hero_image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center mt-4">
                        <button type="submit" class="btn btn-success px-4">
                            <i class="bi bi-save me-1"></i> Save Banner
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
