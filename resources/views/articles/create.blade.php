@extends('layouts.adminapp')

@section('title', 'Create Article')

@section('content')
    <div class="container">
        <h1>Create Article</h1>

        <form method="POST" action="{{ route('articles.store') }}">
            @csrf

            <input class="form-control mb-3" name="title" placeholder="Title">

            <textarea class="form-control mb-3" name="description" placeholder="Short description"></textarea>

            <input class="form-control mb-3" name="image_url" placeholder="Cover image URL">

            <input class="form-control mb-3" name="category" placeholder="Category">

            <select class="form-control mb-3" name="type">
                <option value="news">News</option>
                <option value="feature">Feature</option>
                <option value="opinion">Opinion</option>
                <option value="analysis">Analysis</option>
            </select>

            <input class="form-control mb-3" name="country" placeholder="Country">
            <input class="form-control mb-3" name="continent" placeholder="Continent">
            <input class="form-control mb-3" name="language" placeholder="Language">
            <input class="form-control mb-3" name="author" placeholder="Author">

            <div>
                <textarea name="content" id="editor"></textarea>
            </div>


            <button class="btn btn-primary">Publish</button>
        </form>
    </div>
@endsection