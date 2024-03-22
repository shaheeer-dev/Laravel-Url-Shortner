<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Url;
use Illuminate\Support\Str;

class UrlSeeder extends Seeder
{

  public function run()
  {
    $urls = [
      [
        'title' => 'Google',
        'original_url' => 'https://www.google.com',
        'shortener_url' => config('app.url') . '/' . Str::random(6)
      ],
      [
        'title' => 'GitHub',
        'original_url' => 'https://github.com',
        'shortener_url' => config('app.url') . '/' . Str::random(6)
      ],
      [
        'title' => 'OpenAI',
        'original_url' => 'https://www.openai.com',
        'shortener_url' => config('app.url') . '/' . Str::random(6)
      ],
    ];

    // Create Url records
    foreach ($urls as $urlData) {
        Url::create($urlData);
    }
      
    // Define additional live original URLs
    $additionalUrls = [
        'https://www.youtube.com',
        'https://www.facebook.com',
        'https://www.twitter.com',
        'https://www.instagram.com',
        'https://www.linkedin.com',
        'https://www.reddit.com',
        'https://www.netflix.com',
        'https://www.amazon.com',
        'https://www.apple.com',
        'https://www.microsoft.com',
    ];

      // Create additional Url records
    for ($i = 0; $i < 10; $i++) {
      $shortenerUrl = config('app.url') . '/' . Str::random(6);
      Url::create([
          'title' => 'Additional URL ' . ($i + 1),
          'original_url' => $additionalUrls[$i],
          'shortener_url' => $shortenerUrl
      ]);
    }
  }
}
