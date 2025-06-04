@extends('admin.layouts.admin')
@section('title', 'Banner')
@section('content')

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Create New Banner</div>
                    <hr>

                    <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Column 1: Hero Title & Subtitle -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hero_title">Hero Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="hero_title" name="hero_title" placeholder="Enter Hero Title" required value="{{ old('hero_title') }}">
                                    @error('hero_title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="hero_subtitle">Hero Subtitle <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="hero_subtitle" name="hero_subtitle" placeholder="Enter Hero Subtitle" required value="{{ old('hero_subtitle') }}">
                                    @error('hero_subtitle')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Column 2: CTA Button & Price -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cta_button_text">Short Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="cta_button_text" name="cta_button_text" placeholder="Enter CTA Button Text" required value="{{ old('cta_button_text') }}">
                                    @error('cta_button_text')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="price">Price (Optional)</label>
                                    <input type="text" class="form-control" id="price" name="price" placeholder="Enter Price" value="{{ old('price') }}">
                                    @error('price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Column 3: Hero Image -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="hero_image">Hero Image <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="hero_image" name="hero_image" required>
                                    <img id="image_preview" class="img-fluid mt-2" src="#" alt="Preview" style="display: none; max-height: 200px;">
                                    @error('hero_image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group text-center mt-3">
                            <button type="submit" class="btn btn-success px-5">
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

@section('scripts')
<script>
    // Image Preview
    document.getElementById("hero_image").addEventListener("change", function(e){
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById("image_preview");
            output.src = reader.result;
            output.style.display = "block";
        }
        reader.readAsDataURL(e.target.files[0]);
    });
</script>
@endsection
