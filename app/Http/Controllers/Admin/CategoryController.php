<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Category;
use Illuminate\Validation\Rule;


class CategoryController extends BaseController
{

    private $image_prefix = 'category';

    public function __construct() {
        parent::__construct();
        $this->data['routeType'] = 'category';
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['categories'] = Category::ParentCategories();

         return view('admin.category.view', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['edit']=false;
        return view('admin.category.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name.*' => 'required|string|max:255']);
        $presentCategories = [];
        $image_path_from_public='category';
        foreach($request->name as $k=>$v)
        {
           $category = Category::whereName($v)->first();
           $presentCategories[] = $category;
           if ( isset($request->image[$k]) && ! is_null($request->image[$k]))
           {
            $image_name[$k]=upload_image($request->image[$k], $this->image_prefix,$image_path_from_public);
             $this->fitImage(32,32,$image_name[$k],$image_path_from_public,$image_path_from_public.'/modified');

           }
           
           if (!$category) {
            Category::create([
                'name'  => $v,
                'slug'  => bsb_str_slug($v),
                'image' => isset($image_name[$k])?$image_name[$k]:null,
            ]);
           }
       }



       $filteredCategories = array_pluck(array_filter($presentCategories), 'name');//retrives only name attribute from array
       if (count($filteredCategories) > 0) {
        return back()->with('failure_message', '<b>' . implode(', ', $filteredCategories) . '</b> categories were present before. So, they werent added.');
       }

       return redirect()->route($this->data['routeType'] . '.index')->with('success_message', 'Category successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {

        $this->data['routeType']      = 'sub-category';
        $this->data['category']       = $category;
        $this->data['sub_categories'] = $category->sub_categories;

        return view('admin.category.show', $this->data);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $this->data['edit']     = true;
        $this->data['model'] = $category;
        return view('admin.category.create', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request,[
            'name'=>['required','string','max:100',
            Rule::unique('categories')->ignore($category->id)
            ],

        ]);

         $image_path_from_public='category';
         $image_name=null;

         if (!is_null($request->image))
         {
          $category->delete_image('image','category');
          $image_name=upload_image($request->image, $this->image_prefix,$image_path_from_public);
           $this->fitImage(32,32,$image_name,$image_path_from_public,$image_path_from_public.'/modified');

         }


        return $category->update([
            'name'  => $request->input('name'),
            'image' => $image_name,
        ])
            ? back()->with('success_message', 'Category successfully updated.')
            : back()->with('failure_message', 'Category could not be updated. Please try again later.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($category->delete()) {
            $category->delete_image('image','category');
            if($category->has_children())
            {
                findAndDeleteChild($category->sub_categories);//calling recusive function 


            }
             
            return back()->with('success_message', 'Category successfully deleted.');
        }

        return back()->with('failure_message', 'Category could not be deleted. Please try again later.');
    }



    public function show_on_menu(Category $category) {
        $category->show_on_menu = $category->show_on_menu ? 0 : 1;
        $category->save();

        return response()->json(['message' => $category->name . ($category->show_on_menu ? ' shown in menu' : ' removed from menu')]);
    }

    public function make_exclusive(Category $category) {
        $category->exclusive = $category->exclusive ? 0 : 1;
        $category->save();

        return response()->json(['message' => $category->name . ($category->exclusive ? ' made exclusive' : ' removed from exclusive')]);
    }

    public function set_priority(Category $category) {
        $priority = \request()->priority;

        $category->priority = $priority;
        $category->save();

        return response()->json(['message' => $category->name . ' priority changed to ' . $priority]);
    }
}
