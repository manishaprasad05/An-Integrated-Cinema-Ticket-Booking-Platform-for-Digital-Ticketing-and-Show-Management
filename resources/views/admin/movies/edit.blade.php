@extends('layouts.admin')

@section('content')

<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-lg border-0 rounded-4">

                <!-- Header -->
                <div class="card-header bg-dark text-white text-center rounded-top-4 d-flex justify-content-center align-items-center gap-2">

                    <!-- Yellow Heroicon -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                         width="32"
                         height="32"
                         fill="none"
                         stroke="#facc15"
                         stroke-width="2"
                         viewBox="0 0 24 24">
                        <path d="M12 20h9"/>
                        <path d="M16.5 3.5a2.1 2.1 0 113 3L7 19l-4 1 1-4 12.5-12.5z"/>
                    </svg>

                    <h2 class="mb-0 page-title fw-bold">Edit Movie</h2>
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

                    <form action="{{ route('admin.movies.update', $movie->id) }}"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        {{-- Movie Title --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Movie Title</label>
                            <input type="text"
                                   name="title"
                                   value="{{ old('title', $movie->title) }}"
                                   class="form-control form-control-lg rounded-3"
                                   required>
                        </div>

                        {{-- Description --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="description"
                                      class="form-control rounded-3"
                                      rows="4"
                                      required>{{ old('description', $movie->description) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Language</label>
                                <input type="text"
                                       name="language"
                                       value="{{ old('language', $movie->language) }}"
                                       class="form-control rounded-3"
                                       required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Genre</label>
                                <input type="text"
                                       name="genre"
                                       value="{{ old('genre', $movie->genre) }}"
                                       class="form-control rounded-3"
                                       required>
                            </div>
                        </div>

                        <div class="row">
    <div class="col-md-4 mb-4">
        <label class="form-label fw-bold">Duration (minutes)</label>
        <input type="number"
               name="duration"
               value="{{ old('duration', $movie->duration) }}"
               class="form-control rounded-3"
               required>
    </div>

    <div class="col-md-4 mb-4">
        <label class="form-label fw-bold">Rating</label>
        <input type="number"
               name="rating"
               step="0.1"
               min="0"
               max="10"
               value="{{ old('rating', $movie->rating) }}"
               class="form-control rounded-3"
               required>
    </div>

    {{-- ✅ PRICE FIELD ADDED --}}
    <div class="col-md-4 mb-4">
        <label class="form-label fw-bold">Ticket Price (₹)</label>
        <input type="number"
               name="price"
               step="0.01"
               min="0"
               value="{{ old('price', $movie->price) }}"
               class="form-control rounded-3"
               placeholder="Enter ticket price"
               required>
    </div>
</div>

                        {{-- Current Poster --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Current Poster</label><br>

                            @if($movie->poster)
                                <img src="{{ asset('storage/posters/'.$movie->poster) }}"
                                     width="150"
                                     class="rounded shadow-sm mb-2">
                            @else
                                <p class="text-muted">No poster uploaded</p>
                            @endif
                        </div>

                        {{-- Change Poster --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Change Poster</label>
                            <input type="file"
                                   name="poster"
                                   class="form-control rounded-3"
                                   accept="image/*"
                                   onchange="previewImage(event)">
                        </div>

                        {{-- Image Preview --}}
                        <div class="text-center mb-4">
                            <img id="preview"
                                 width="180"
                                 class="rounded-4 shadow-sm"
                                 style="display:none;">
                        </div>

                        {{-- Buttons --}}
                        
                            <a href="{{ route('admin.movies.index') }}"
                               class="btn btn-danger rounded-3">
                                Cancel
                            </a>

                            <button type="submit"
                                    class="btn btn-primary rounded-3">
                                Update Movie
                            </button>

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
