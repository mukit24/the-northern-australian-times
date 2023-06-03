@extends('layouts.app')

@section('content')
@auth
<div class="container p-4">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <h2 class="text-center text-success">Publish An Article</h2>
        <form action="/create-article" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" required id="title" placeholder="article title">
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Article Body</label>
            <textarea type="text" class="form-control" name="body" required id="body" placeholder="Details of the article"></textarea>
        </div>
        <select name="tag" class="form-select" required>
            <option selected>Select A Tag</option>
            <option value="Politics">Politics</option>
            <option value="Food">Food</option>
            <option value="Business">Business</option>
            <option value="Environment">Environment</option>
            <option value="Sports">Sports</option>
            <option value="Health">Health</option>
            <option value="Entertainment">Entertainment</option>
        </select>
        <div class="my-3">
            <label for="formFile" class="form-label">Image(Optional)</label>
            <input class="form-control" name="image" type="file" id="formFile">
        </div>
        <button type="submit" class="btn btn-success w-100">Save Article</button>
        </form>
        </div>
    </div>
</div>
@endauth
@endsection