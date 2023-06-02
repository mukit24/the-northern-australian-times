@extends('layouts.app')

@section('content')
<h1>Edit Article</h1>
<form action="/edit-article/{{$article->id}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="text" name="title" placeholder="post title" value="{{$article->title}}">
    <textarea name="body" placeholder="body content...">{{$article->body}}</textarea>
    <select name="tag">
        <option value="sports" {{ $article->tag === 'sports' ? 'selected' : '' }}>sports</option>
        <option value="health" {{ $article->tag === 'health' ? 'selected' : '' }}>health</option>
        <option value="entertainment" {{ $article->tag === 'entertainment' ? 'selected' : '' }}>entertainment</option>
    </select>
    <input type="file" name="image">
    <button type="submit">Save Post</button>
</form>
@endsection