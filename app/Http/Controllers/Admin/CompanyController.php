<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Company;
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class CompanyController extends BaseController
{
    protected $image_prefix = 'company';
   
    public function edit($id)
    {
        $this->data['company'] = Company::findOrFail($id);

        return view('admin.company.view', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, $id)
    {
            $company                   = Company::findOrFail($id);
            $established_date          = new Carbon($request->established_date);
            $old_name                  = $company->name;
            $company->name             = $request->name;
            $company->email            = $request->email;
            $company->phone            = $request->phone;
            $company->established_date = $established_date->toDateTimeString();
            $company->address          = $request->address;
            $company->youtube          = $request->youtube;
            $company->instagram          = $request->instagram;
            $company->about            = $request->about;
            $company->facebook_url     = $request->facebook_url;
            $company->twitter_url      = $request->twitter_url;
            $company->offer            =$request->offer;
            $company->terms_condition  =$request->terms_condition;

            if ( ! is_null($request->logo)) {
                $image_path_from_public='company';
                $company->delete_image('logo',$image_path_from_public);
                $company->logo = $image_name=upload_image($request->logo, $this->image_prefix,$image_path_from_public);

                $this->fitImage(100,80,$image_name,$image_path_from_public,$image_path_from_public.'/modified');
            }

            if ($company->save()) {
                return $request->ajax()
                    ? response()->json(['result' => 'Successfully updated: ' . $old_name . ' to ' . $company->name], 200)
                    : redirect()->back()->with('success_message', 'Successfully updated');
            } else {
                return $request->ajax()
                    ? response()->json(['result' => 'Sorry, could not update. Please try again later'], 200)
                    : redirect()->back()->with('failure_message', 'Sorry, company information could not be updated. Please try again later!');
            }
        }

        
    

    
}
