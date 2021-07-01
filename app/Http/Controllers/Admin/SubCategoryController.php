<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Category;
use Illuminate\Validation\Rule;


class SubCategoryController extends BaseController
{

    private $image_prefix = 'sub-category';

    public function __construct() {
        parent::__construct();
        $this->data['routeType'] = 'sub-category';
        

         
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->data['sub_categories'] = SubCategory::latest()->with('category')->paginate($this->default_pagination_limit);

        return view('admin.sub_category.view', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['category']=Category::find(request()->category_id);
        $this->data['edit']       = false;
        return view('admin.sub_category.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        

        
          // $request->validate([
          //   'name'=>'required|array',
          //   'name.*'=>['string','max:100',
          //             Rule::unique('categories')->where(function ($query) use ($request) {
          //              return $query->where('parent_id', $request->category_id);
          //                 }) 
          //         ],
          //         'category_id'=>'required|numeric'
          //      ]);
       
        $request->validate(['name.*' => 'required|string|max:255']);
        $presentCategories = [];
        $image_path_from_public='category';
        foreach($request->name as $k=>$v)
        {
           // $category = Category::whereName($v)->first();
           
           // $presentCategories[] = $category;

           if ( isset($request->image[$k]) && ! is_null($request->image[$k]))
           {
            $image_name[$k]=upload_image($request->image[$k], $this->image_prefix,$image_path_from_public);
             $this->fitImage(32,32,$image_name[$k],$image_path_from_public,$image_path_from_public.'/modified');

           }
           
           // if (!$category) {
            $parent_category=Category::where('id',$request->category_id)->first();
            $parent_category->sub_categories()->create([
                'name'  => $v,
                'slug'  => bsb_str_slug($v),
                'image' => isset($image_name[$k])?$image_name[$k]:null,
                'is_parent'=>1
            ]);
           // }
       }

       // $filteredCategories = array_pluck(array_filter($presentCategories), 'name');//retrives only name attribute from array
       // if (count($filteredCategories) > 0) {
       //  return back()->with('failure_message', '<b>' . implode(', ', $filteredCategories) . '</b> sub categories were present before. So, they werent added.');
       // }

       return redirect()->route('category.show',$request->category_id)->with('success_message', 'Sub Category successfully added.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category=Category::find($id);
        $this->data['routeType']    = 'sub-category';
        $this->data['category'] = $category;
        $this->data['sub_categories'] = $category->sub_categories;
       return view('admin.sub_category.show', $this->data);
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['model']=Category::find($id);
        $this->data['category']=Category::find($id)->parent_category;
        $this->data['edit']=true;
        return view('admin.sub_category.create',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

       
        $this->validate($request,[
                        'name'=>['bail','required','string','max:100',
                        Rule::unique('categories')->ignore($id)->where(function ($query) use ($request) {
                         return $query->where('parent_id', $request->category_id);
                            }) 
                    ],
                    'category_id'=>'required|numeric|min:1',
                    
                 ]);

        $sub_category=Category::find($id);
        $image_name=null;

        $image_path_from_public='category';
        if (!is_null($request->image))
         {
          $sub_category->delete_image('image','category');
          $image_name=upload_image($request->image, $this->image_prefix,$image_path_from_public);
           $this->fitImage(32,32,$image_name,$image_path_from_public,$image_path_from_public.'/modified');

         }


       

        return $sub_category->update([
            'name'        => $request->name,
            'image'       =>$image_name,
            'is_parent'   => 1
        ])
            ? redirect()->route('category.show', $request->category_id)->with('success_message', 'SubCategory successfully updated.')
            : back()->with('failure_message', 'SubCategory could not be updated. Please try again later.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub_category=Category::find($id);
        if ($sub_category->delete()) {
            $sub_category->delete_image('image','category');
            if($sub_category->has_children())
            {
                findAndDeleteChild($sub_category->sub_categories);


            }
            return back()->with('success_message', 'SubCategory successfully deleted.');
        }

        return back()->with('failure_message', 'SubCategory could not be deleted. Please try again later.');

    }
}
