<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\ImageUpload\Strategy\UploadWithAspectRatio;
use Intervention\Image\Facades\Image;
use App\Services\SliderImageUploader;
use App\Slider;

class SliderController extends BaseController
{
    private $viewPath = 'admin.slider';
    protected $image_prefix = 'slider';

    public function __construct() {
        parent::__construct();
        $this->data['routeType'] = 'slider';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['models'] = Slider::select('id', 'image', 'url')->get();

        return view($this->viewPath . '.view', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['edit'] = false;
        return view("{$this->viewPath}.create", $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'url'=>'required|max:255'
        ]);

        $image_name = null;
        $image_path_from_public='sliders';

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $uploader = new SliderImageUploader(new UploadWithAspectRatio());

            $data['image'] = $uploader->saveOriginalImage($image);

            $this->cropAndSaveImage(
                $uploader,
                $data['image'],
                $request->x1,
                $request->y1,
                $request->w,
                $request->h
            );
            $image_name = $data['image'];

        } else if ( ! is_null($request->file('image'))) {
            $image_name = upload_image($request->file('image'), $this->image_prefix,$image_path_from_public);
            $this->fitImage(1920,850,$image_name,$image_path_from_public,$image_path_from_public.'/modified');
            $this->fitImage(480,578,$image_name,$image_path_from_public,$image_path_from_public.'/mobile');
        }

        return Slider::create([
            'image' => $image_name,
            'url'   => $request->input('url'),
            'title' =>$request->input('title'),
            'sub_title' =>$request->input('sub_title'),
            'offer_title' =>$request->input('offer_title'),
        ])
            ? redirect()->route($this->data['routeType'] . '.index')->with('success_message', 'Slider successfully added.')
            : redirect()->route($this->data['routeType'] . '.index')->with('failure_message', 'Slider could not be added. Please try again later.');
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
    public function edit(Slider $slider)
    {
        $this->data['edit']  = true;
        $this->data['model'] = $slider;

        return view("{$this->viewPath}.create", $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $image_path_from_public='sliders';
        $image_name = $slider->getOriginal('image');

        if ($request->hasFile('image') || $request->croppreviousimage == 'true') {
            $uploader = new SliderImageUploader(new UploadWithAspectRatio());

            $uploader->deleteModifiedImage($slider->image);

            $uploader->deleteMobileImage($slider->image);

            if ($request->croppreviousimage == 'true') {
                $data['image'] = $slider->image;
            } else {
                $uploader->deleteFullImage($slider->image);

                $data['image'] = $uploader->saveOriginalImage($request->file('image'));
            }

            $this->cropAndSaveImage(
                $uploader,
                $data['image'],
                $request->x1,
                $request->y1,
                $request->w,
                $request->h
            );
            $image_name = $data['image'];
        }

        return $slider->update([
            'image' => $image_name,
            'url'   => $request->input('url'),
            'title' =>$request->input('title'),
            'sub_title'=>$request->input('sub_title'),
            'offer_title'=>$request->input('offer_title'),
        ])
            ? back()->with('success_message', 'Slider successfully updated.')
            : back()->with('failure_message', 'Slider could not be updated. Please try again later.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        try {
            $slider->delete();
            $slider->delete_image('image','sliders');

            return back()->with('success_message', 'Slider successfully deleted.');
        } catch (\Exception $exception) {
            return back()->with('failure_message', 'Slider could not be deleted. Please try again later.');
        }
    }

    private function cropAndSaveImage($uploader, $filename, $posX1, $posY1, $width, $height)
    {
        $imgPath = $uploader->getFullImagePath($filename);

        $fullImage = Image::make($imgPath);

        $cropDestPath = $uploader->getModifiedImagePath($filename);

        $uploader->cropAndSaveImage($fullImage, $cropDestPath, $posX1, $posY1, $width, $height);

        $uploader->cropAndSaveImageMobile($fullImage, $filename);
    }
}
