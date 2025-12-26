@extends('layouts.adminapp')

@section('content')
<div class="container">
    <div class="row">

        {{-- LEFT: EDIT FORM --}}
        <div class="col-md-8">
            <h3>Edit Article</h3>

            <form method="POST" action="{{ route('articles.update', $article->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Title</label>
                    <input type="text"
                           name="title"
                           class="form-control"
                           value="{{ old('title', $article->title) }}">
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description"
                              class="form-control"
                              rows="2">{{ old('description', $article->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Image URL</label>
                    <input type="text"
                           name="image_url"
                           class="form-control"
                           value="{{ old('image_url', $article->image_url) }}">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Category</label>
                        <input type="text"
                               name="category"
                               class="form-control"
                               value="{{ old('category', $article->category) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Type</label>
                        <select name="type" class="form-control">
                            @foreach(['news','feature','opinion','analysis'] as $type)
                                <option value="{{ $type }}"
                                    @selected($article->type === $type)>
                                    {{ ucfirst($type) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Country</label>
                        <input type="text"
                               name="country"
                               class="form-control"
                               value="{{ $article->country }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Continent</label>
                        <input type="text"
                               name="continent"
                               class="form-control"
                               value="{{ $article->continent }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label>Language</label>
                    <input type="text"
                           name="language"
                           class="form-control"
                           value="{{ $article->language }}">
                </div>

                <div class="mb-3">
                    <label>Author</label>
                    <input type="text"
                           name="author"
                           class="form-control"
                           value="{{ $article->author }}">
                </div>

                <div class="mb-3">
                    <label>Published At</label>
                    <input type="datetime-local"
                           name="published_at"
                           class="form-control"
                           value="{{ optional($article->published_at)->format('Y-m-d\TH:i') }}">
                </div>

                <div class="mb-3">
                    <label>Content</label>
                    <textarea name="content"
                              class="form-control"
                              rows="8">{{ old('content', $article->content) }}</textarea>
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox"
                           name="is_trending"
                           value="1"
                           class="form-check-input"
                           @checked($article->is_trending)>
                    <label class="form-check-label">Trending</label>
                </div>

                <button class="btn btn-primary">Update Article</button>
            </form>
        </div>

        {{-- RIGHT: ARTICLE LIST + SEARCH --}}
        <div class="col-md-4">
            <h5>All Articles</h5>

            <form method="GET" class="mb-3">
                <input type="text"
                       name="q"
                       value="{{ request('q') }}"
                       class="form-control"
                       placeholder="Search by title...">
            </form>

            <div class="list-group" style="max-height: 600px; overflow-y: auto;">
                @foreach ($articles as $item)
                    <a href="{{ route('articles.edit', $item->id) }}"
                       class="list-group-item list-group-item-action
                       {{ $item->id === $article->id ? 'active' : '' }}">
                        <strong>{{ Str::limit($item->title, 40) }}</strong>
                        <br>
                        <small class="text-muted">
                            {{ $item->created_at->format('d M Y') }}
                        </small>
                    </a>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection
