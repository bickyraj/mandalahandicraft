<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Requests\NewsRequest;
use App\News;

class NewsController extends BaseController
{

    private $image_prefix = 'news';

    public function __construct()
    {
      parent::__construct();
      $this->data['routeType'] = 'news';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $this->data['news'] = News::latest()->paginate($this->default_pagination_limit);
         return view('admin.news.view', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['edit'] = false;

        return view('admin.news.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        $image_name = null;
        $image_path_from_public='news';
        if (!is_null($request->image)) {
          $image_name = upload_image($request->image, $this->image_prefix,$image_path_from_public);
          $this->resizeImage(847,400,$image_name,$image_path_from_public,$image_path_from_public.'/modified');
        }

        return News::create([
          'title'       => $request->title,
          'slug'        => bsb_str_slug($request->title),
          'image'       => $image_name,
          'description' => $request->description,
        ])
          ? back()->with('success_message', 'News successfully added.')
          : back()->with('failure_message', 'News could not be added. Please try again later.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $this->data['edit'] = true;
        $this->data['news'] = $news;

        return view('admin.news.create', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, News $news)
    {
        $image_path_from_public='news';
        $image_name = $news->getOriginal('image');
        if (!is_null($request->image)) {
          $news->delete_image('image','news');
          $image_name = upload_image($request->image, $this->image_prefix,$image_path_from_public);
          $this->resizeImage(847,400,$image_name,$image_path_from_public,$image_path_from_public.'/modified');
        }

        return $news->update([
          'title'       => $request->title,
          'slug'        => bsb_str_slug($request->title),
          'image'       => $image_name,
          'description' => $request->description,
        ])
          ? back()->with('success_message', 'News successfully updated.')
          : back()->with('failure_message', 'News could not be updated. Please try again later.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        if ($news->delete()) {
          $news->delete_image('image','news');

          return back()->with('success_message', 'News successfully deleted.');
        }

        return back()->with('failure_message', 'News could not be deleted. Please try again later.');
    }
}
