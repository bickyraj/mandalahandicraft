<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use App\Http\Controllers\BaseController;
use App\Http\Requests\StoreGroupSize;
use Illuminate\Http\Request;

class GroupController extends BaseController
{

    public function __construct() {
        parent::__construct();
        $this->data['routeType'] = 'groups';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['groups'] = Group::with('group_sizes')->get();
        return view('admin.groups.index', $this->data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['edit']=false;
        return view('admin.groups.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupSize $request)
    {
        $groupModel = new Group();
        $status = $groupModel->addGroupSize($request->all());

        if ($status != 1) {
            return back()->with('failure_message', 'Something went wrong. Please try again.');
        }

        return redirect()->route($this->data['routeType'] . '.index')->with('success_message', 'Size Group successfully added.');

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
    public function edit(Group $group)
    {
        $this->data['group'] = Group::with('group_sizes')->findOrFail($group->id);

        return view('admin.groups.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $status = 0;
        $group->name = $request->name;

        if ($group->save()) {

            if (isset($request->sizes)) {
                $sizes = $request->sizes;

                foreach ($sizes as $key=>$size) {
                    $group->group_sizes()
                        ->where('id', $key)
                        ->update(['size' => $size]);
                }
            }

            // to insert new sizes
            if (isset($request->new_sizes)) {
                $sizes = $request->new_sizes;

                foreach ($sizes as $key=>$size) {
                    $group->group_sizes()
                        ->insert(['group_id'=>$group->id, 'size' => $size]);
                }
            }

            $status = 1;

            return redirect()->back()->with('success_message','Size group updated successfully!');
        }

        return redirect()->back()->with('failure_message','Something went wrong. Please try again.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        if($group->delete())
        {
            return redirect()->back()->with('success_message','Group deleted successfully!');
        }
    }
}
