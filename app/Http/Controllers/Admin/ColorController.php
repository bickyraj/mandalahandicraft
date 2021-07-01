<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Color;
use Illuminate\Validation\Rule;

class ColorController extends BaseController
{

    private $image_prefix = 'color';

    public function __construct() {
        parent::__construct();
        $this->data['routeType'] = 'color';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['colors'] = Color::orderBy('name')->get();

         return view('admin.color.view', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['edit']=false;
        return view('admin.color.create',$this->data);
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
            'name'=>'required|array|min:1',
            'name.*'=>'string|unique:colors,name',
            'image.*'=>'nullable|image|max:2048'
//            'image.*'=>'nullable|image|dimensions:max_width=200,max_height=232|max:2048'
        ],[
//            'image.*.dimensions'=>'The image must be ratio of 200x232px.',
            'name.*.unique'=>'The color is already taken!',
        ]);

       

        $image_path_from_public='color';
        foreach($request->name as $k=>$v)
        {
          
           if ( isset($request->image[$k]) && ! is_null($request->image[$k]))
           {
            $image_name[$k]=upload_image($request->image[$k], $this->image_prefix,$image_path_from_public);
             $this->fitImage(175,207,$image_name[$k],$image_path_from_public,$image_path_from_public.'/modified');

           }
           
        
            Color::create([
                'name'  => $v,
                'color_code'=>$request->color_code[$k],
                'image' => isset($image_name[$k])?$image_name[$k]:null,
            ]);
        }


         return redirect()->route($this->data['routeType'] . '.index')->with('success_message', 'Color successfully added.');
         

        
        
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
    public function edit(Color $color)
    {
        $this->data['edit']=true;
        $this->data['model']=$color;
        return view('admin.color.create',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Color $color)
    {
        $this->validate($request,[
            'name'=>['required','string','max:50',
            Rule::unique('colors')->ignore($color->id)
            ],

        ]);


         $image_path_from_public='color';
         $image_name=$color->image;

         if (!is_null($request->image))
         {
          $color->delete_image('image','color');
          $image_name=upload_image($request->image, $this->image_prefix,$image_path_from_public);
           $this->fitImage(175,207,$image_name,$image_path_from_public,$image_path_from_public.'/modified');

         }


        return $color->update([
            'name'  => $request->input('name'),
            'color_code'=>$request->color_code,
            'image' => $image_name,
        ])
            ? back()->with('success_message', 'Color successfully updated.')
            : back()->with('failure_message', 'Color could not be updated. Please try again later.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        if($color->delete())
        {
            $color->delete_image('image','color');
            return redirect()->back()->with('success_message','Color deleted successfully!');

        }
    }
}
