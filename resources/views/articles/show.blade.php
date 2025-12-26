@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">

        {{-- MAIN ARTICLE --}}
        <div class="col-lg-8">

            <h1 class="mb-3">{{ $article->title }}</h1>

            <p class="text-muted mb-4">
                By {{ $article->author }}
                • {{ $article->published_at?->format('d M Y') }}
                • {{ $article->views }} views
            </p>

            @if ($article->image_url)
                <div class="text-center mb-4">
                    <img src="{{ $article->image_url }}"
                         class="img-fluid rounded article-image"
                         alt="{{ $article->title }}">
                </div>
            @endif

            <div class="article-content">
                {!! $article->content !!}
            </div>

        </div>

        {{-- SIDEBAR --}}
        <div class="col-lg-4">

            <div class="sticky-top" style="top: 80px;">

                <h6 class="fw-bold text-uppercase border-start border-warning ps-2 mb-3">
                    Must Reads
                </h6>

                @foreach ($sidebar as $item)
                    <div class="d-flex mb-3">

                        @if ($item->image_url)
                            <img src="{{ $item->image_url }}"
                                 width="80"
                                 height="60"
                                 class="rounded object-fit-cover me-2"
                                 alt="{{ $item->title }}">
                        @endif

                        <div>
                            <a href="{{ route('articles.show', $item->id) }}"
                               class="small fw-semibold text-dark text-decoration-none">
                                {{ Str::limit($item->title, 60) }}
                            </a>

                            <div class="text-muted small">
                                {{ $item->views }} views
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>

    </div>

</div>
@endsection
