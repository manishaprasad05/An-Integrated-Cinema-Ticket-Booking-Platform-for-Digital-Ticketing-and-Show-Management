@extends('layouts.admin')

@section('content')

<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-lg border-0 rounded-4">

                <div class="card-header bg-dark text-white text-center rounded-top-4 
            d-flex justify-content-center align-items-center gap-2">

    <!-- Movie Add Icon (Heroicon Style) -->
    <svg xmlns="http://www.w3.org/2000/svg"
         class="hero-icon"
         width="30"
         height="30"
         fill="none"
         viewBox="0 0 24 24"
         stroke="#facc15"
         stroke-width="2"
         stroke-linecap="round"
         stroke-linejoin="round">
        <path d="M12 5v14" />
        <path d="M5 12h14" />
    </svg>

    <h3 class="mb-0 page-title fw-bold">Add New Movie</h3>

</div>

                <div class="card-body p-4">

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger rounded-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.movies.store') }}" 
                          method="POST" 
                          enctype="multipart/form-data">

                        @csrf

                        {{-- Movie Title --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Movie Title</label>
                            <input type="text" 
                                   name="title" 
                                   value="{{ old('title') }}"
                                   class="form-control form-control-lg rounded-3"
                                   placeholder="Enter movie title"
                                   required>
                        </div>

                        {{-- Description --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="description" 
                                      class="form-control rounded-3"
                                      rows="4"
                                      placeholder="Enter movie description"
                                      required>{{ old('description') }}</textarea>
                        </div>

                        <div class="row">
                            {{-- Language --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Language</label>
                                <input type="text" 
                                       name="language" 
                                       value="{{ old('language') }}"
                                       class="form-control rounded-3"
                                       placeholder="e.g. English"
                                       required>
                            </div>

                            {{-- Genre --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Genre</label>
                                <input type="text" 
                                       name="genre" 
                                       value="{{ old('genre') }}"
                                       class="form-control rounded-3"
                                       placeholder="e.g. Action, Drama"
                                       required>
                            </div>
                        </div>

                       <div class="row">

    {{-- Duration --}}
    <div class="col-md-4 mb-4">
        <label class="form-label fw-bold">Duration (minutes)</label>
        <input type="number" 
               name="duration" 
               placeholder="Enter Duration"
               value="{{ old('duration') }}"
               class="form-control rounded-3"
               required>
    </div>

    {{-- Rating --}}
    <div class="col-md-4 mb-4">
        <label class="form-label fw-bold">Rating (1-5)</label>
        <input type="number" 
               name="rating" 
               step="0.1"
               min="1"
               max="10"
               placeholder="Enter Rating"
               value="{{ old('rating') }}"
               class="form-control rounded-3"
               required>
    </div>

    {{-- Price --}}
    <div class="col-md-4 mb-4">
        <label class="form-label fw-bold">Ticket Price (₹)</label>
        <input type="number" 
               name="price" 
               step="0.01"
               min="0"
               value="{{ old('price') }}"
               class="form-control rounded-3"
               placeholder="Enter ticket price"
               required>
    </div>

</div>

                        {{-- Trailer URL --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Trailer URL (YouTube Link)</label>
                            <input type="url" 
                                   name="trailer_url" 
                                   value="{{ old('trailer_url') }}"
                                   class="form-control rounded-3"
                                   placeholder="https://youtube.com/...">
                        </div>

                        {{-- Upload Poster --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Movie Poster</label>
                            <input type="file" 
                                   name="poster" 
                                   class="form-control rounded-3" 
                                   accept="image/*"
                                   onchange="previewImage(event)"
                                   required>
                        </div>

                        {{-- Image Preview --}}
                        <div class="text-center mb-4">
                            <img id="preview" width="180" 
                                 class="rounded-4 shadow-sm"
                                 style="display:none;">
                        </div>

                        {{-- Buttons --}}
                        
                           <button type="submit" class="btn btn-primary">Add Movie</button>
                            <a href="{{ route('admin.movies.index') }}" class="btn btn-danger">Cancel</a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

{{-- Live Image Preview Script --}}
<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('preview');
        output.src = reader.result;
        output.style.display = "block";
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>

@endsection
