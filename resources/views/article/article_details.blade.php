@extends('layouts.app')
@section('content')
<div class="container p-5">
    <div class="row">
        <div class="col-lg-8">
            @if(session('message'))
            <div class="alert alert-success fw-bold alert-dismissible text-center mb-3 fade show">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <h3 class="text-success">{{ $article->title }} <span class="text-secondary">by
                    {{$article->user->name}}</span></h3>
            <div class="d-flex mb-2">
                @if(Auth::check() && Auth::user()->id === $article->user_id)
                <a href="{{ route('displayEdit', $article->id) }}"><button
                        class="btn btn-primary me-1 btn-sm">Edit</button></a>
                @endif
                @if(Auth::check() && (Auth::user()->id === $article->user_id || Auth:: user()->is_admin === 1))
                <form action="{{ route('deleteArticle', $article->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
                @endif
            </div>
            <h6 class="text-muted">Published at {{$article->created_at->format('d-m-Y h:i A')}}</h6>
            <h6><span class="badge bg-dark">{{$article->tag}}</span></h6>
            <p style="text-align: justify">{{ $article->body }}</p>
            @if($article->image)
            <img class="img-fluid" src="{{ asset('storage/images/' . $article->image) }}" alt="Post Image">
            @endif
        </div>
        <div class="col-lg-4">
            <h4 class="text-center text-primary">Comments ({{ $article->comments->count() }})</h4>
            @forelse($article->comments as $comment)
            <div class="py-2">
                <h6><span class="text-success">{{ $comment->username }}</span> Commented on {{$comment->created_at->format('d-m-Y h:i A')}}</h6>
                <p class="ms-3 text-muted">{{ $comment->body }}</p>
                @if(Auth::check() && Auth:: user()->is_admin === 1)
                <form action="{{ route('deleteComment', ['article_id' => $article->id, 'comment_id' => $comment->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
                @endif
            </div>
            @empty
            <h5 class="text-danger">No comments found</h5>
            @endforelse
            <h6 class="text-primary">Write A Comment</h6>
            <form action="{{ route('createComment', $article->id) }}" method="POST">
                @csrf
                <div class="mb-2">
                    <input type="text" class="form-control" id="name" placeholder="Write Your Name" name="username">
                </div>
                <div class="mb-2">
                    <textarea type="text" class="form-control" id="body" placeholder="Write Your Comment"
                        name="body"></textarea>
                </div>
                <button type="submit" class="btn btn-success btn-sm w-100">Save Comment</button>
            </form>
        </div>
    </div>
</div>
@endsection