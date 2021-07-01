<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Faq;

class FaqController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        parent::__construct();
        $this->data['routeType'] = 'faq';
    }

    public function index()
    {
         $this->data['faqs'] = Faq::orderBy('priority')->get();

         return view('admin.faq.view', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['edit']=false;
        return view('admin.faq.create',$this->data);
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
            'question'=>'required|string|max:255',
            'answer'=>'required|string',
            'priority'=>'nullable|integer',
        ]);

        $faq=new Faq();
        $faq->question=$request->question;
        $faq->answer=$request->answer;
        if(!is_null($request->priority))
        {
            $faq->priority=$request->priority;

        }
        
        if($faq->save())
        {
               return redirect()->route($this->data['routeType'] . '.index')->with('success_message', 'Faq successfully added.');

        }
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
    public function edit(Faq $faq)
    {
        $this->data['edit']=true;
        $this->data['faq']=$faq;
        return view('admin.faq.create',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        $this->validate($request,[
            'question'=>'required|string|max:255',
            'answer'=>'required|string',
            'priority'=>'nullable|integer',
        ]);

        $faq->question=$request->question;
        $faq->answer=$request->answer;
        if(!is_null($request->priority))
        {
            $faq->priority=$request->priority;

        }
        
        if($faq->save())
        {
               return redirect()->route($this->data['routeType'] . '.index')->with('success_message', 'Faq successfully updated.');

        }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        if($faq->delete())
        {
            return redirect()->route($this->data['routeType'] . '.index')->with('success_message', 'Faq successfully deleted.');


        }
    }
}
