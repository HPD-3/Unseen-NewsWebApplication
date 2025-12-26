<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $types = ['news', 'feature', 'opinion', 'analysis'];
        $continents = ['Africa', 'Asia', 'Europe', 'Middle East', 'Americas'];
        $countries = [
            'Africa' => ['Nigeria', 'Kenya', 'South Africa'],
            'Asia' => ['Indonesia', 'China', 'India'],
            'Europe' => ['France', 'Germany', 'UK'],
            'Middle East' => ['Qatar', 'Saudi Arabia', 'UAE'],
            'Americas' => ['USA', 'Brazil', 'Canada'],
        ];

        Article::truncate();

        for ($i = 1; $i <= 25; $i++) {
            $continent = $continents[array_rand($continents)];
            $country = $countries[$continent][array_rand($countries[$continent])];

            Article::create([
                'title' => "Sample Article {$i}: " . Str::title(Str::random(8)),
                'description' => 'This is a short summary of the article, written for preview cards and SEO.',
                'image_url' => 'https://picsum.photos/800/500?random=' . $i,
                'category' => 'World',
                'type' => $types[array_rand($types)],
                'continent' => $continent,
                'country' => $country,
                'language' => 'en',
                'content' => $this->dummyContent(),
                'views' => rand(10, 5000),
                'author' => 'Unseen Editorial',
                'is_trending' => false,
                'published_at' => Carbon::now()->subDays(rand(0, 30)),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Set ONE trending article (highest views)
        $top = Article::orderByDesc('views')->first();
        if ($top) {
            $top->update(['is_trending' => true]);
        }
    }

    private function dummyContent(): string
    {
        return <<<HTML
<h2>Background</h2>
<p>This article explores current global developments, providing insight and context.</p>

<h2>Key Points</h2>
<ul>
    <li>Major political and economic shifts</li>
    <li>Regional impact and global response</li>
    <li>Expert analysis and public reaction</li>
</ul>

<h2>Analysis</h2>
<p>Analysts suggest that the situation will continue to evolve in the coming weeks.</p>

<p>The long-term implications remain uncertain, but observers agree this marks a significant moment.</p>
HTML;
    }
}
