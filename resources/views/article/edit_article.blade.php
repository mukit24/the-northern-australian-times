@extends('layouts.app')

@section('content')
@auth
<div class="container p-4">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <h2 class="text-center text-primary">Edit An Article</h2>
        <form action="/edit-article/{{$article->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" required id="title" placeholder="article title" value="{{$article->title}}">
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Article Body</label>
            <textarea type="text" class="form-control" name="body" required id="body" placeholder="Details of the article">{{$article->body}}</textarea>
        </div>
        <select name="tag" class="form-select" required>
            <option selected>Select A Tag</option>
            <option value="Politics" {{ $article->tag === 'Politics' ? 'selected' : '' }}>Politics</option>
            <option value="Food" {{ $article->tag === 'Food' ? 'selected' : '' }}>Food</option>
            <option value="Business" {{ $article->tag === 'Business' ? 'selected' : '' }}>Business</option>
            <option value="Environment" {{ $article->tag === 'Environment' ? 'selected' : '' }}>Environment</option>
            <option value="Sports" {{ $article->tag === 'Sports' ? 'selected' : '' }}>Sports</option>
            <option value="Heath" {{ $article->tag === 'Heath' ? 'selected' : '' }}>Heath</option>
            <option value="Entertainment" {{ $article->tag === 'Entertainment' ? 'selected' : '' }}>Entertainment</option>
        </select>
        <div class="my-3">
            <label for="formFile" class="form-label">Image</label>
            <input class="form-control" name="image" type="file" id="formFile">
        </div>
        <button type="submit" class="btn btn-primary w-100">Save Article</button>
        </form>
        </div>
    </div>
</div>
@endauth
@endsection