{{-- Dengan menggunakan sebuah directiv milik blade yang bernama @add  --}}
{{-- @dd($posts) --}}


@extends('layouts.main')

@section('container')

<h1 class="mt-4 mb-6 text-center">{{ $title }}</h1>

<div class="row justify-content-center mb-3">
    <div class="col-md-6">
        <form action="/posts">
            @if (request('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
            @endif

            @if (request('author'))
            <input type="hidden" name="author" value="{{ request('author') }}">
            @endif

            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search..." name = "search" value="{{ request('search') }}">
                <button class="btn btn-danger" type="submit">
                    Search
                </button>
              </div>
        </form>
    </div>
</div>

@if ($posts->count())

<div class="card mb-5">
    @if ($posts[0]->image)
    <div class="" style="">
       <img src="{{ asset('storage/' . $posts[0]->image) }}" alt="{{ $posts[0]->category->name }}" class="img-fluid">
   </div>
    @else
    <img src="https://source.unsplash.com/random/100×100?{{ $posts[0]->category->name }}" class="card-img-top" alt="{{ $posts[0]->category->name }}">
    @endif
    <div class="card-body text-center">
      <h2 class="card-title">
        <a href="/posts/{{ $posts[0]->slug }}" class="text-dark">{{ $posts[0]->title }}
        </a>
    </h2>
      <p>
        <small class="text-muted">
        By, <a href="/posts?author=
            {{ $posts[0]->author->username }}">
            {{ $posts[0]->author->name }}
        </a> in <a href="/posts?category={{ $posts[0]->category->slug }}" class="text-decoration-none">{{ $posts[0]->category->name }}
        </a> {{ $posts[0]->created_at->diffForHumans() }} </small>
    </p>
      <p class="card-text">{{ $posts[0]->excerpt }}</p>
      <a href="/posts/{{ $posts[0]->slug }}"class="text-decoration-none btn btn-primary">Read More..</a>
    </div>
</div>


{{-- struktur halaman, kita butuh colom masing2 ukurannya 4 --}}
<div class="container">
  <div class="row">
    @foreach ($posts->skip(1) as $post )
    <div class="col-md-4 mb-3">
      <div class="card">
        <div class="position-absolute px-2 py-2" style="background-color:rgba(0,0,0,0.7)"><a href="/posts?category={{ $post->category->slug }}" class=" text-white text-decoration-none">{{ $post->category->name }}</a>
        </div>
        @if ($post->image)
           <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid">
        @else
        <img src="https://source.unsplash.com/random/100×100?{{ $post->category->name }}" class="card-img-top" alt="{{ $post->category->name }}">
        @endif
               <div class="card-body">
                 <h5 class="card-title">{{ $post->title }}</h5>
                   <p><small class="text-muted">
                       By, <a href="/posts?author=/{{ $post->author->username }}">
                    {{ $post->author->name }}
                    </a>{{ $post->created_at->diffForHumans() }} </small>
                   </p>
                  <p class="card-text">{{ $post->excerpt }}</p>
                  <a href="/posts/{{ $post->slug }}" class="btn btn-primary">Read More...</a>
               </div>
      </div>
    </div>
    @endforeach
  </div>
</div>

{{-- looping nya blade --}}
{{-- @foreach ($posts->skip(1) as $post)
<article class="mb-5 border-bottom pb-4">
  <h2><a href="/posts/{{ $post->slug }}" class="text-decoration-none">{{ $post->title }}</a></h2>

  <p>By, <a href="/authors/{{ $post->author->username }}">{{ $post->author->name }}</a> in <a href="/categories/{{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }}</a></p>

  <p>{{ $post->excerpt }}</p>

  <a href="/posts/{{ $post->slug }}"class="text-decoration-none">Read More..</a>

</article>


@endforeach --}}
@else
  <p class="text-center fs-4">Tidak ada Postingan.</p>

@endif
<div class="d-flex justify-content-end">
    {{ $posts->links() }}
    {{-- ini pagination --}}
    </div>
@endsection



