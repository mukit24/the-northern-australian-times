@extends('layouts.app')

@section('content')
<h1>{{ $article->title }}</h1>
<h3>{{ $article->user->name}}</h3>
<p>{{ $article->body }}</p>
@if($article->image)
    <img src="{{ asset('storage/images/' . $article->image) }}" alt="Post Image">
@endif
<form action="{{ route('createComment', $article->id) }}" method="POST">
    @csrf
    <input type="text" name="username" placeholder="your name">
    <textarea name="body" placeholder="body content..."></textarea>
    <button type="submit">Save Comment</button>
</form>
<h2>Comments ({{ $article->comments->count() }})</h2>
@forelse($article->comments as $comment)
    <div>
        <p>{{ $comment->username }}</p>
        <p>{{ $comment->body }}</p>
    </div>
@empty
    <h2>No comments found</h2>
@endforelse
@endsection