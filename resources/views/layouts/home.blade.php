@extends('layouts.app')

@section('content')
<section class="container px-5 pt-5">
    <h2 class="text-primary">Hello Everyone,</h2>
    <h2>Welcome To <span class="text-success">The Northern Australian Times</span></h2>
    <p class="lead text-muted" style="text-align: justify">The Northern Australian Times is a leading online news website dedicated to providing up-to-date and comprehensive coverage of news, events, and stories from the Northern region of Australia. The website delivers timely and reliable news articles, investigative reports, and feature stories that encompass various topics including politics, business, environment, culture, and sports. The Northern Australian Times aims to keep readers informed and engaged by delivering accurate and unbiased news content through its user-friendly interface. Whether it's breaking news or in-depth analysis, the website serves as a trusted source for the latest happenings in the dynamic Northern Australian region.</p>
    @auth
    <a href="/"><button class="btn btn-outline-success me-3">Join As A Journalist</button></a>
    @else
    <a href="/login"><button class="btn btn-outline-success me-3">Join As A Journalist</button></a>   
    @endauth
    <a href="/articles"><button class="btn btn-primary">Explore Articles</button></a>
</section>
<section class="container p-5">
    <h2 class="text-center text-success mb-4">Latest Articles</h2>
    <div class="row g-3">
        @foreach($articles as $article)
        <div class="col-lg-4">
            <div class="card h-100">
                @if($article->image)
                <img src="{{ asset('storage/images/' . $article->image) }}" alt="Post Image" class="card-img-top">
                @endif
                <div class="card-body">
                  <h6 class="card-title m-0">{{$article->title}} <span class="text-secondary">by {{$article->user->name}}</span></h6>
                  <small class="text-muted fw-bold">Published at {{$article->created_at->format('d-m-Y')}}</small>
                  <p class="card-text mb-1">{{\Illuminate\Support\Str::limit($article->body,5)}}</p>
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

</section>

@endsection