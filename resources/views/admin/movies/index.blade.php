@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-center align-items-center mb-4 gap-2">

    <svg class="title-icon" xmlns="http://www.w3.org/2000/svg"
         width="32"
         height="32"
         fill="none"
         stroke="currentColor"
         stroke-width="2"
         viewBox="0 0 24 24">
        <rect x="3" y="4" width="18" height="16" rx="2"/>
        <path d="M7 4v16M17 4v16"/>
    </svg>

    <h1 class="mb-0 page-title">All Movies</h1>

</div>



<table class="table table-dark">
<tr>
<th>Poster</th>
<th>Title</th>
<th>Action</th>
</tr>

@foreach($movies as $movie)
<tr>
<td>
<img src="{{ asset('storage/posters/'.$movie->poster) }}" width="60">
</td>

<td>{{ $movie->title }}</td>

<td>
<a href="{{ route('admin.movies.edit',$movie->id) }}" class="btn btn-info">
    Edit
</a>

<form action="{{ route('admin.movies.destroy',$movie->id) }}" 
      method="POST" 
      style="display:inline;">

@csrf 
@method('DELETE')
<button class="btn btn-danger">Delete</button>
</form>
</td>
</tr>
@endforeach

</table>

@endsection
