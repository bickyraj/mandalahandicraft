<?php

namespace App\Http\Controllers\Admin;

use App\Attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Page;
use App\Services\SlugService;
use Illuminate\Validation\Rule;


class PageController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->data['routeType'] = 'admin.pages';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['pages'] = Page::paginate(10);
        return view('admin.pages.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['edit'] = false;
        return view('admin.pages.create', $this->data);
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
            $page = new Page;
            $page->name = $request->name;
            $page->slug = SlugService::generate('Page', $request->name);
            $page->description = $request->description;
            $page->save();
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
        }
        return redirect()->route($this->data['routeType'] . '.index', $page->page_id)->with('success_message', 'Page successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {

        $this->data['routeType']      = 'page';
        $this->data['page']       = $page;
        return view('admin.pages.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::find($id);
        $this->data['edit']     = true;
        $this->data['model']    = $page;
        return view('admin.pages.create', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $this->validate($request, [
            'name' => 'required|unique:pages,id,' . $page->id,
            'description' => 'required'
        ]);
        $page->save();
        return back()->with('success_message', 'Page successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($pageId)
    {
        try {
            $page = Page::find($pageId);
            if ($page->delete()) {
                return back()->with('success_message', 'Page successfully deleted.');
            }

            throw new \Exception("Error Processing Request", 1);

        } catch (\Throwable $th) {
            \Log::info($th->getMessage());
            return back()->with('failure_message', 'Page could not be deleted. Please try again later.');
        }

    }
}
