@extends('admin.layouts.admin')
@section('title', 'Add New Game')
@section('content')

<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Add New Game</div>
                <hr>

                <form action="{{ route('games.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- First Column (50%) -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Game Name</label>
                                <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="" disabled selected>Select a Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="logo">Game Logo</label>
                                <input type="file" name="logo" id="logo" class="form-control" required>
                                <img id="logo_preview" class="img-fluid mt-2" src="#" alt="Logo Preview" style="display: none; max-height: 200px;">
                                @error('logo')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Second Column (50%) -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Description</label>
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
                            <i class="bi bi-save me-1"></i> Save Game
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
    // Image Preview
    document.getElementById("logo").addEventListener("change", function(e){
        var reader = new FileReader();
        var output = document.getElementById("logo_preview");

        if (e.target.files.length > 0) {
            reader.onload = function() {
                output.src = reader.result;
                output.style.display = "block";
            }
            reader.readAsDataURL(e.target.files[0]);
        } else {
            output.style.display = "none";
        }
    });
</script>
@endsection
