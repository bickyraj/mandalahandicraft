<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Attribute;
use App\Services\SlugService;
use Illuminate\Validation\Rule;


class AttributeController extends BaseController
{

    private $image_prefix = 'attribute';

    public function __construct()
    {
        parent::__construct();
        $this->data['routeType'] = 'attribute';
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['attributes'] = Attribute::ParentAttributes();

        return view('admin.attribute.view', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['edit'] = false;
        return view('admin.attribute.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name.*' => 'required|string|max:255|unique:attributes,name']);
        $presentAttributes = [];
        foreach ($request->name as $k => $v) {
            $attribute = Attribute::whereName($v)->first();
            $presentAttributes[] = $attribute;
            if (!$attribute) {
                Attribute::create([
                    'name'  => $v,
                    'slug'  => SlugService::generate('Attribute', $v),
                ]);
            }
        }



        $filteredAttributes = array_pluck(array_filter($presentAttributes), 'name'); //retrives only name attribute from array
        if (count($filteredAttributes) > 0) {
            return back()->with('failure_message', '<b>' . implode(', ', $filteredAttributes) . '</b> attributes were present before. So, they werent added.');
        }

        return redirect()->route($this->data['routeType'] . '.index')->with('success_message', 'Attribute successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Attribute $attribute)
    {

        $this->data['routeType']      = 'sub-attribute';
        $this->data['attribute']       = $attribute;
        $this->data['sub_attributes'] = $attribute->sub_attributes;

        return view('admin.attribute.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        $this->data['edit']     = true;
        $this->data['model'] = $attribute;
        return view('admin.attribute.create', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
        $this->validate($request, [
            'name' => [
                'required', 'string', 'max:100',
                Rule::unique('attributes')->ignore($attribute->id)
            ],
        ]);

        $attribute->slug = "";
        $attribute->save();

        return $attribute->update([
            'name'  => $request->input('name'),
            'slug'  => SlugService::generate('Attribute', $request->name),
        ])
            ? back()->with('success_message', 'Attribute successfully updated.')
            : back()->with('failure_message', 'Attribute could not be updated. Please try again later.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        if ($attribute->delete()) {
            $attribute->delete_image('image', 'attribute');
            if ($attribute->has_children()) {
                findAndDeleteChild($attribute->sub_attributes); //calling recusive function


            }

            return back()->with('success_message', 'Attribute successfully deleted.');
        }

        return back()->with('failure_message', 'Attribute could not be deleted. Please try again later.');
    }



    public function show_on_menu(Attribute $attribute)
    {
        $attribute->show_on_menu = $attribute->show_on_menu ? 0 : 1;
        $attribute->save();

        return response()->json(['message' => $attribute->name . ($attribute->show_on_menu ? ' shown in menu' : ' removed from menu')]);
    }

    public function make_exclusive(Attribute $attribute)
    {
        $attribute->exclusive = $attribute->exclusive ? 0 : 1;
        $attribute->save();

        return response()->json(['message' => $attribute->name . ($attribute->exclusive ? ' made exclusive' : ' removed from exclusive')]);
    }

    public function set_priority(Attribute $attribute)
    {
        $priority = \request()->priority;

        $attribute->priority = $priority;
        $attribute->save();

        return response()->json(['message' => $attribute->name . ' priority changed to ' . $priority]);
    }
}
