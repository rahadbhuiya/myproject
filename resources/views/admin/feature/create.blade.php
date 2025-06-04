@extends('admin.layouts.admin')
@section('title', 'Create Feature')
@section('content')

<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Create New Feature</div>
                <hr>

                <form action="{{ route('features.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- First Column (50%) -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Feature Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" class="form-control" required value="{{ old('title') }}">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Second Column (50%) -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Feature Description</label>
                                <textarea name="description" id="description" class="form-control" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group py-2">
                        <div class="icheck-material-white">
                            <input type="checkbox" id="agree_terms" name="agree_terms" checked=""/>
                            <label for="agree_terms">I Agree to the Terms & Conditions</label>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-light px-5">
                            <i class="bi bi-save me-1"></i> Save Feature
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Optional JavaScript for any dynamic behavior (if required)
</script>
@endsection
