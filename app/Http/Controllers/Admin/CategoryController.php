<?php

namespace App\Http\Controllers\Admin;

use App\Attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Category;
use App\CategoryAttribute;
use App\Services\SlugService;
use Illuminate\Validation\Rule;


class CategoryController extends BaseController
{

    private $image_prefix = 'category';

    public function __construct()
    {
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
        $this->data['edit'] = false;
        $this->data['attributes'] = Attribute::where('status', 1)->get();
        return view('admin.category.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        try {
            $category = new Category;
            $category->name = $request->name;
            $category->slug = SlugService::generate('Category', $request->name);
            if ($category->save()) {
                foreach ($request->input('attributes') as $attr) {
                    $category->attributes()->attach($attr);
                }
            }
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
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
        $this->data['attributes'] = Attribute::where('status', 1)->get();
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
        $this->validate($request, [
            'name' => [
                'required', 'string', 'max:100',
                Rule::unique('categories')->ignore($category->id)
            ],
            'attributes.*' => 'required'

        ]);
        $category->slug = "";
        $category->save();
        $category->name = $request->name;
        $category->slug = SlugService::generate('Category', $request->name);
        if ($category->save()) {
            $category->attributes()->detach();
            foreach ($request->input('attributes') as $attr) {
                $category->attributes()->attach($attr);
            }
        }

        return back()->with('success_message', 'Category successfully updated.');
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
            $category->delete_image('image', 'category');
            if ($category->has_children()) {
                findAndDeleteChild($category->sub_categories); //calling recusive function


            }

            return back()->with('success_message', 'Category successfully deleted.');
        }

        return back()->with('failure_message', 'Category could not be deleted. Please try again later.');
    }



    public function show_on_menu(Category $category)
    {
        $category->show_on_menu = $category->show_on_menu ? 0 : 1;
        $category->save();

        return response()->json(['message' => $category->name . ($category->show_on_menu ? ' shown in menu' : ' removed from menu')]);
    }

    public function make_exclusive(Category $category)
    {
        $category->exclusive = $category->exclusive ? 0 : 1;
        $category->save();

        return response()->json(['message' => $category->name . ($category->exclusive ? ' made exclusive' : ' removed from exclusive')]);
    }

    public function set_priority(Category $category)
    {
        $priority = \request()->priority;

        $category->priority = $priority;
        $category->save();

        return response()->json(['message' => $category->name . ' priority changed to ' . $priority]);
    }

    public function getAttributes($categoryId)
    {
        $category = Category::find($categoryId);
        $attrs = $category->attributes;
        return response()->json([
            'data' => $attrs,
            'message' => 'Data fetched.',
            'success' => true
        ]);
    }
}
