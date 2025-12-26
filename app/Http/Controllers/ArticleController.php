<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of published articles.
     */
   public function index(Request $request)
{
    $query = Article::query();

    // Filter by type (news, feature, opinion, analysis)
    if ($request->filled('type')) {
        $query->where('type', $request->type);
    }

    // Filter by continent
    if ($request->filled('continent')) {
        $query->where('continent', $request->continent);
    }

    // Search by title
    if ($request->filled('q')) {
        $query->where('title', 'like', '%' . $request->q . '%');
    }

    // FEATURED (highest views)
    $featured = (clone $query)
        ->orderByDesc('views')
        ->first();

    // SECONDARY (next 4)
    $secondary = (clone $query)
        ->when($featured, fn ($q) => $q->where('id', '!=', $featured->id))
        ->orderByDesc('views')
        ->limit(4)
        ->get();

    // OTHERS (next 12)
    $others = (clone $query)
        ->whereNotIn('id', collect([$featured?->id])
            ->merge($secondary->pluck('id'))
            ->filter()
            ->all()
        )
        ->orderByDesc('views')
        ->limit(12)
        ->get();

    return view('articles.index', compact(
        'featured',
        'secondary',
        'others'
    ));
}


    public function create()
    {
        return view('articles.create');
    }

    /**
     * Display the specified article.
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);
        $article->increment('views');

        // Sidebar content (excluding current article)
        $sidebar = Article::where('id', '!=', $article->id)
            ->orderByDesc('views')
            ->limit(5)
            ->get();

        return view('articles.show', compact('article', 'sidebar'));
    }

    /**
     * Store a newly created article.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|string',
            'category' => 'required|string|max:100',
            'type' => 'required|in:news,feature,opinion,analysis',
            'country' => 'required|string|max:100',
            'continent' => 'required|string|max:100',
            'language' => 'required|string|max:10',
            'content' => 'required|string',
            'author' => 'required|string|max:100',
            'published_at' => 'nullable|date',
        ]);

        $article = Article::create([
            ...$validated,
            'published_at' => $validated['published_at'] ?? null,
        ]);

        return response()->json($article, 201);
    }

    /**
     * Update the specified article.
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'image_url' => 'nullable|string',
            'category' => 'sometimes|required|string|max:100',
            'type' => 'sometimes|required|in:news,feature,opinion,analysis',
            'country' => 'sometimes|required|string|max:100',
            'continent' => 'sometimes|required|string|max:100',
            'language' => 'sometimes|required|string|max:10',
            'content' => 'sometimes|required|string',
            'author' => 'sometimes|required|string|max:100',
            'published_at' => 'nullable|date',
            'is_trending' => 'sometimes|boolean',
        ]);

        if (! empty($validated['is_trending'])) {
            Article::query()->update(['is_trending' => false]);
        }

        $article->update($validated);

        return response()->json($article);
    }

    public function edit(Request $request, $id)
{
    $article = Article::findOrFail($id);

    $articles = Article::query()
        ->when($request->filled('q'), function ($query) use ($request) {
            $query->where('title', 'like', '%' . $request->q . '%');
        })
        ->orderByDesc('created_at')
        ->get();

    return view('articles.edit', compact('article', 'articles'));
}


    /**
     * Remove the specified article.
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return response()->json(null, 204);
    }
}
