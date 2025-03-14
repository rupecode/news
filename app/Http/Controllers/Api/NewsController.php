<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Http\Resources\NewsCollection;
use App\Http\Resources\NewsResource;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('News',
            ['news' => new NewsCollection(News::query()->with('owner')->orderBy('id', 'desc')->get())]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsRequest $request)
    {
        News::query()->create(
            array_merge($request->validated(), ['user_id' => Auth::id()])
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return Inertia::render('NewsItem', ['item' => new NewsResource(News::query()->find($id))]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsRequest $request, int $id)
    {
        $news = News::query()->findOrFail($id);
        $news->update($request->validated());

        return new NewsResource($news);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $news = News::query()->findOrFail($id);
        $news->delete();

        return response()->noContent();
    }
}
