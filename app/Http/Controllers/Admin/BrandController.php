<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BrandController extends BaseController
{
     private $image_prefix = 'brand';
    public function __construct() {
        parent::__construct();
        $this->data['routeType'] = 'brands';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['brands'] = Brand::orderBy('brand_name')->get();

        return view('admin.brands.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['edit']=false;
        return view('admin.brands.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'brand_name'=>'required|array|min:1',
            'brand_name.*'=>'string|unique:brands,brand_name',
            'image.*'=>'nullable|image|dimensions:max_width=200,max_height=232|max:1024',
            'url'=>'array',
            'url.*'=>'max:255'
        ],[
            'image.*.dimensions'=>'The image must be ratio of 200x232px.',
            'name.*.unique'=>'The brand is already taken!',
        ]);

        $image_path_from_public='brands';
        foreach($request->brand_name as $k=>$v)
        {

            if ( isset($request->image[$k]) && ! is_null($request->image[$k]))
            {
                $image_name[$k]=upload_image($request->image[$k], $this->image_prefix,$image_path_from_public);
                $this->fitImage(175,207,$image_name[$k],$image_path_from_public,$image_path_from_public.'/modified');

            }


            Brand::create([
                'brand_name'  => $v,
                'url'=>$request->url[$k],
                'image' => isset($image_name[$k])?$image_name[$k]:null,
            ]);
        }

        return redirect()->route($this->data['routeType'] . '.index')->with('success_message', 'Brand successfully added.');
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
    public function edit(Brand $brand)
    {
        $this->data['edit'] = true;
        $this->data['model'] = $brand;

        return view('admin.brands.create',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $this->validate($request,[
            'brand_name'=> [ 'required','string','max:255',
                Rule::unique('brands')->ignore($brand->id),
            ],
            'image'=>'nullable|image|dimensions:max_width=200,max_height=232|max:1024',
            'url'=>'url',
        ]);


        $image_path_from_public='brands';
        $image_name=$brand->image;

        if (!is_null($request->image))
        {
            $brand->delete_image('image','brands');
            $image_name=upload_image($request->image, $this->image_prefix,$image_path_from_public);
            $this->fitImage(175,207,$image_name,$image_path_from_public,$image_path_from_public.'/modified');

        }

        return $brand->update([
            'brand_name'  => $request->input('brand_name'),
            'url'=>$request->url,
            'image' => $image_name,
        ])
            ? back()->with('success_message', 'Brand successfully updated.')
            : back()->with('failure_message', 'Brand could not be updated. Please try again later.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        if($brand->delete())
        {
            $brand->delete_image('image','brands');
            return redirect()->back()->with('success_message','Color deleted successfully!');

        }
    }
}
