<?php

namespace App\Http\Controllers\Admin;

use App\Attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\ProductFaq;
use App\Services\SlugService;
use Illuminate\Validation\Rule;


class ProductFaqController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->data['routeType'] = 'admin.productfaq';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($productId)
    {
        $this->data['faqs'] = ProductFaq::where('product_id', $productId)->paginate(10);
        return view('admin.product_faq.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($productId)
    {
        $this->data['edit'] = false;
        return view('admin.product_faq.create', $this->data);
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
            'name' => 'required|string|max:255',
            'description' => 'required'
        ]);
        try {
            $faq = new ProductFaq;
            $faq->name = $request->name;
            $faq->product_id = $request->product_id;
            $faq->description = $request->description;
            $faq->save();
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
        }
        return redirect()->route($this->data['routeType'] . '.index', $faq->product_id)->with('success_message', 'ProductFaq successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProductFaq $faq)
    {

        $this->data['routeType']      = 'product-faq';
        $this->data['faq']       = $faq;

        return view('admin.product_faq.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faq = ProductFaq::find($id);
        $this->data['edit']     = true;
        $this->data['model']    = $faq;
        return view('admin.product_faq.create', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductFaq $faq)
    {
        $this->validate($request, [
            'name' => [
                'required', 'string', 'max:100',
                Rule::unique('product_faqs')->ignore($faq->id)
            ],
            'descriptions' => 'required'

        ]);
        $faq->save();
        return back()->with('success_message', 'Product Faq successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductFaq $faq)
    {
        if ($faq->delete()) {
            return back()->with('success_message', 'Product Faq successfully deleted.');
        }

        return back()->with('failure_message', 'Product Faq could not be deleted. Please try again later.');
    }

    public function show_on_menu(ProductFaq $faq)
    {
        $faq->show_on_menu = $faq->show_on_menu ? 0 : 1;
        $faq->save();

        return response()->json(['message' => $faq->name . ($faq->show_on_menu ? ' shown in menu' : ' removed from menu')]);
    }
}
