<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsResource;
use App\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->limit(10)->get();
        return NewsResource::collection($news);
    }
}
