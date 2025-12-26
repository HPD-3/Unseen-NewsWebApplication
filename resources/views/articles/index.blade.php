@extends('layouts.app')

@section('content')
<div class="container">

    {{-- TOP GRID --}}
    <div class="row g-4">

        {{-- FEATURED ARTICLE --}}
        <div class="col-lg-6">
            @if ($featured)
                <div class="card border-0">

                    <img src="{{ $featured->image_url }}"
                         class="img-fluid rounded">

                    <div class="mt-3">
                        <span class="badge bg-warning text-dark mb-2">
                            TRENDING
                        </span>

                        <h2 class="fw-bold">
                            <a href="{{ route('articles.show', $featured->id) }}"
                               class="text-dark text-decoration-none">
                                {{ $featured->title }}
                            </a>
                        </h2>

                        <p class="text-muted">
                            {{ $featured->published_at?->format('d M Y') }}
                            • {{ $featured->views }} views
                        </p>

                        <p>
                            {{ Str::limit(strip_tags($featured->content), 180) }}
                        </p>
                    </div>
                </div>
            @endif
        </div>

        {{-- SECONDARY ARTICLES --}}
        <div class="col-lg-3">
            @foreach ($secondary as $article)
                <div class="mb-4">

                    <img src="{{ $article->image_url }}"
                         class="img-fluid rounded mb-2">

                    <h6 class="fw-semibold">
                        <a href="{{ route('articles.show', $article->id) }}"
                           class="text-dark text-decoration-none">
                            {{ $article->title }}
                        </a>
                    </h6>

                    <p class="text-muted small">
                        {{ $article->views }} views
                    </p>
                </div>
            @endforeach
        </div>

        {{-- MUST READS --}}
        <div class="col-lg-3">
            <h6 class="fw-bold text-uppercase border-start border-warning ps-2">
                Must Reads
            </h6>

            @foreach ($others->take(5) as $article)
                <div class="d-flex mb-3">
                    <img src="{{ $article->image_url }}"
                         width="80"
                         class="rounded me-2">

                    <div>
                        <a href="{{ route('articles.show', $article->id) }}"
                           class="small fw-semibold text-dark text-decoration-none">
                            {{ Str::limit($article->title, 60) }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    {{-- MORE HEADLINES --}}
    <hr class="my-5">

    <h4 class="fw-bold mb-4">More Headlines</h4>

    <div class="row g-4">
        @foreach ($others->skip(5) as $article)
            <div class="col-md-4">
                <div class="card border-0 h-100">

                    <img src="{{ $article->image_url }}"
                         class="card-img-top rounded">

                    <div class="card-body">
                        <h6>
                            <a href="{{ route('articles.show', $article->id) }}"
                               class="text-dark text-decoration-none">
                                {{ $article->title }}
                            </a>
                        </h6>
                        <p class="text-muted small">
                            {{ $article->views }} views
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection
