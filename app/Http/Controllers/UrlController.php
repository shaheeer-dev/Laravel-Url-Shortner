<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Ariaieboy\LaravelSafeBrowsing\LaravelSafeBrowsing;

class UrlController extends Controller
{
    public function index()
    {
        return view('urls.index', [
            'urls' => Url::latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'original_url' => 'required|string|max:255',
        ]);

        $original_url = $request->original_url;

        $safeBrowsing = new LaravelSafeBrowsing();

        if (!$safeBrowsing->isSafeUrl($original_url)) {
            return response()->json(['error' => 'The URL is not safe.'], 400);
        }

        $urlModel = Url::create([
            'title' => Str::ucfirst($request->title),
            'original_url' => $original_url,
            'shortener_url' => config('app.url') . '/' . Str::random(6)
            ,
        ]);

        return $urlModel;
    }

    public function edit(Url $url)
    {
        return view('urls.edit', [
            'url' => $url,
        ]);
    }

    public function update(Request $request, Url $url)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'original_url' => 'required|string|max:255',
        ]);
        $validated['shortener_url'] = Str::random(5);
        $url->update($validated);
        return redirect(route('urls.index'));
    }

    public function destroy(Url $url)
    {
        $url->delete();
        return response()->json(['message' => 'URL Deleted Successfully'], 200);
    }
}
