@extends('layouts.app')

@section('content')
<div class="container p-4">
    <h2 class="text-center text-primary">All Articles</h2>
    <div class="text-center">
        <a href="/create-article-page"><button class="btn btn-success">Publish An Article</button></a>
    </div>
    @if(session('message'))
    <div class="alert alert-dark fw-bold alert-dismissible text-center my-4 fade show">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="row pt-4 g-3">
        @foreach($articles as $article)
        <div class="col-lg-4">
            <div class="card h-100">
                @if($article->image)
                <img src="{{ asset('storage/images/' . $article->image) }}" alt="Post Image" class="card-img-top">
                @endif
                <div class="card-body">
                  <h6 class="card-title m-0">{{$article->title}} <span class="text-primary">by {{$article->user->name}}</span></h6>
                  <small class="text-muted fw-bold">Published at {{$article->created_at->format('d-m-Y h:i A')}}</small>
                  <p class="card-text mb-1">{{\Illuminate\Support\Str::limit($article->body,30)}}</p>
                  <p class="card-text mb-2"><span class="badge bg-dark">{{$article->tag}}</span></p>
                  <div class="d-flex">
                    <a href="{{ route('articleDetails', $article->id) }}"><button class="btn btn-success me-1 btn-sm">Details</button></a>
                    @if(Auth::check() && Auth::user()->id === $article->user_id)
                    <a href="{{ route('displayEdit', $article->id) }}"><button class="btn btn-primary me-1 btn-sm">Edit</button></a>
                    @endif
                    @if(Auth::check() && (Auth::user()->id === $article->user_id || Auth:: user()->is_admin === 1))
                    <form action="{{ route('deleteArticle', $article->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                    @endif
                  </div>
                  
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


@endsection