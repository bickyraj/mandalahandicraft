<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AdvertisementRequest;
use App\Image;
use App\Advertisement;

class AdvertisementController extends BaseController
{
    private $viewPath = 'admin.advertisement';
    private $image_prefix = 'ads';


    public function __construct() {
        parent::__construct();
        $this->data['routeType'] = 'advertisement';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->data['advertisements'] = Advertisement::with('image')->orderBy('home', 'desc')->latest()->get();

        return view("{$this->viewPath}.view", $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['edit'] = false;

        return view("{$this->viewPath}.create", $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvertisementRequest $request)
    {

        DB::transaction(function () use ($request) {
            $image_path_from_public='ads';
            $advertisement = Advertisement::create([
                'title' => $request->input('title'),
                'url'   => $request->input('url'),
                'home'  => $request->input('home') ? 1 : 0,
            ]);

            if ( ! is_null($request->file('image'))) {
                $image_name = upload_image($request->file('image'), $this->image_prefix,$image_path_from_public);
                $advertisement->image()->create(['image' => $image_name]);
            }
        });

        return redirect()->route($this->data['routeType'] . '.index')->with('success_message', 'Advertisement successfully added.');
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
    public function edit(Advertisement $advertisement)
    {
        $this->data['edit']  = true;
        $this->data['model'] = $advertisement;

        return view("{$this->viewPath}.create", $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdvertisementRequest $request, Advertisement $advertisement)
    {
        $image_path_from_public='ads';
        $advertisement->update([
            'title' => $request->input('title'),
            'url'   => $request->input('url'),
            'home'  => $request->input('home') ? 1 : 0,
        ]);

        if ( ! is_null($request->file('image'))) {
            $image_name = upload_image($request->file('image'), $this->image_prefix,$image_path_from_public);

            /** @var Image $advertisement */
          
           
                $advertisement->image->delete_image('image','ads');
               
           
                $advertisement->image()->update(['image' => $image_name]);
          
        }

        return back()->with('success_message', 'Advertisement successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertisement $advertisement)
    {
        try {
            if($advertisement->image)
            {
                 $advertisement->image->delete_image('image','ads');
            }
           
            $advertisement->image()->delete();
            $advertisement->delete();

            return back()->with('success_message', 'Advertisement successfully deleted.');
        } catch (\Exception $exception) {
            return back()->with('failure_message', 'Advertisement could not be deleted. Please try again later.');
        }
    }
}
