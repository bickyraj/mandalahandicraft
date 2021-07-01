<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SliderResource;
use App\Slider;

class SliderController extends Controller
{
    public function index()
    {
        return SliderResource::collection(Slider::latest()->get());
    }
}
