<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Setting;
use App\Services\ImageUpload\Strategy\UploadWithAspectRatio;
use App\Services\SiteSettingImageUploader;
use Illuminate\Support\Facades\Storage;
use Image;
use Illuminate\Support\Facades\Log;

class SiteSettingController extends Controller
{
    public function general()
    {
        return view('admin.siteSettings.index');
    }

    public function seoManager()
    {
        return view('admin.siteSettings.seo-manager');
    }

    public function generalStore(Request $request)
    {
        $request->validate([
            'email' => 'nullable|email'
        ]);
        Setting::update('site_name', $request->get('site_name'));
        Setting::update('email', $request->get('email'));
        Setting::update('telephone', $request->get('telephone'));
        Setting::update('mobile1', $request->get('mobile1'));
        Setting::update('mobile2', $request->get('mobile2'));
        Setting::update('address', $request->get('address'));
        Setting::update('office_time', $request->get('office_time'));

        // site config data
        // $siteConfig = [
        //     'system_name' => $request->get('system_name'),
        //     'system_email' => $request->get('system_email'),
        //     'system_slogan' => $request->get('system_slogan'),

        // ];

        // Setting::update('siteconfig', $siteConfig);

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $brand_image = time() . '-' . rand(111111, 999999) . '.' . $image->getClientOriginalExtension();

            $path = public_path() . "/uploads/config/";

            $image->move($path, $brand_image);
            Setting::update('brand_image', $brand_image);
        }

        if ($request->hasFile('brand_image_footer')) {
            $image = $request->file('brand_image_footer');
            $brand_image_footer = time() . '-' . rand(111111, 999999) . '.' . $image->getClientOriginalExtension();

            $path = public_path() . "/uploads/config/";

            $image->move($path, $brand_image_footer);
            Setting::update('brand_image_footer', $brand_image_footer);
        }

        session()->flash('success_message', __('alerts.update_success'));
        return redirect()->route('admin.settings.general');
    }

    public function socialMediaStore(Request $request)
    {
        Setting::update('pinterest', $request->get('pinterest'));
        Setting::update('flicker', $request->get('flicker'));
        Setting::update('facebook', $request->get('facebook'));
        Setting::update('instagram', $request->get('instagram'));
        Setting::update('twitter', $request->get('twitter'));
        Setting::update('whatsapp', $request->get('whatsapp'));
        Setting::update('viber', $request->get('viber'));

        session()->flash('success_message', __('alerts.update_success'));
        return redirect()->route('admin.settings.general');
    }

    public function homePageStore(Request $request)
    {
        $old_image = "";
        $request->validate([
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
        ]);

        if (isset(Setting::get('homePage')['block1']['image'])) {
            $old_image = Setting::get('homePage')['block1']['image'];
            // $request->merge(['chairman_image' => $old_image]);
            $request->merge([
                'block1' => array_merge($request->block1, ['image' => $old_image])
            ]);
        } else {
            $request->merge([
                'block1' => array_merge($request->block1, ['image' => ""])
            ]);
        }

        try {

            Setting::update('homePage', $request->except('_token', 'image', 'cropped_data'));
            $path = 'public/home-page/';
            $image_path_from_public = 'site-settings';
            if ($request->hasFile('image') || $request->croppreviousimage == 'true') {

                $image = $request->file('image');

                $uploader = new SiteSettingImageUploader(new UploadWithAspectRatio());

                $uploader->deleteModifiedImage(Setting::get('homePage')['block1']['image']);

                $uploader->deleteMobileImage(Setting::get('homePage')['block1']['image']);

                if ($request->croppreviousimage == 'true') {
                    $data['image'] = Setting::get('homePage')['block1']['image'];
                } else {
                    $uploader->deleteFullImage(Setting::get('homePage')['block1']['image']);

                    $data['image'] = $uploader->saveOriginalImage($request->file('image'));
                }

                $this->cropAndSaveImage(
                    $uploader,
                    $data['image'],
                    $request->cropped_data['x1'],
                    $request->cropped_data['y1'],
                    $request->cropped_data['w'],
                    $request->cropped_data['h']
                );
                $image_name = $data['image'];
                $request->merge([
                    'block1' => array_merge($request->block1, ['image' => $image_name])
                ]);
                Setting::update('homePage', $request->except('_token', 'image', 'cropped_data'));

            } else if ( ! is_null($request->file('image'))) {
                $image_name = upload_image($request->file('image'), $this->image_prefix,$image_path_from_public);
                $this->fitImage(1920,850,$image_name,$image_path_from_public,$image_path_from_public.'/modified');
                $this->fitImage(480,578,$image_name,$image_path_from_public,$image_path_from_public.'/mobile');
            }

            session()->flash('success_message', __('alerts.update_success'));
            return redirect()->route('admin.site_settings.general');
        } catch (\Exception $e) {
            session()->flash('success_message', __('alerts.update_success'));
            return redirect()->back();
        }
    }

    public function seoManagerStore(Request $request)
    {
        $old_image = "";
        $request->validate([
            'file' => 'nullable|image|mimes:png,jpg,jpeg',
        ]);

        if (isset(Setting::get('homePageSeo')['og_image'])) {
            $old_image = Setting::get('homePageSeo')['og_image'];
            $request->merge(['og_image' => $old_image]);
        } else {
            $request->merge(['og_image' => ""]);
        }

        if ($request->hasFile('file')) {
            $imageName = $request->file->getClientOriginalName();
            $imageSize = $request->file->getClientSize();
            $imageType = $request->file->getClientOriginalExtension();
            $imageName = md5(microtime()) . '.' . $imageType;
            $request->merge(['og_image' => $imageName]);
        }

        try {

            Setting::update('homePageSeo', $request->except('_token', 'file', 'cropped_data'));
            $path = 'public/site-settings/';
            if ($request->hasFile('file')) {
                if ($old_image) {
                    Storage::delete($path . '/' . $old_image);
                }

                $image_quality = 100;

                if (($imageSize / 1000000) > 1) {
                    $image_quality = 75;
                }

                $image = Image::make($request->file);
                Storage::put($path . '/' . $imageName, (string) $image->encode('jpg', $image_quality));
            }

            session()->flash('success_message', __('alerts.update_success'));
            return redirect()->back();
        } catch (\Exception $e) {
            session()->flash('success_message', __('alerts.update_success'));
            return redirect()->back();
        }
    }

    public function contactUsStore(Request $request)
    {
        Setting::update('contactUs', $request->except('_token'));

        session()->flash('success_message', __('alerts.update_success'));
        return redirect()->route('admin.settings.general');
    }

    public function imgDimension()
    {
        $data['breadcrumbs'] = '<li><a href="' . route('admin.dashboard') . '">Home</a></li><li>Meta Settings</li>';
        $data['title'] = "Meta Settings - " . Setting::get('siteconfig')['system_name'];
        $data['side_nav'] = 'master_config';
        $data['side_sub_nav'] = 'img-dimension';

        return view('adminsetting::image', $data);
    }

    public function imgDimensionStore(Request $request)
    {
        $request->get('mobile_ad_width') ? Setting::update('mobile_ad_width', $request->get('mobile_ad_width')) : '';
        $request->get('mobile_ad_height') ? Setting::update('mobile_ad_height', $request->get('mobile_ad_height')) : '';

        session()->flash('success_message', __('alerts.update_success'));

        return  redirect()->route('admin.setting.img-dimension');
    }

    private function cropAndSaveImage($uploader, $filename, $posX1, $posY1, $width, $height)
    {
        $imgPath = $uploader->getFullImagePath($filename);

        $fullImage = Image::make($imgPath);

        $cropDestPath = $uploader->getModifiedImagePath($filename);

        $uploader->cropAndSaveImage($fullImage, $cropDestPath, $posX1, $posY1, $width, $height);

        $uploader->cropAndSaveImageMobile($fullImage, $filename);
    }
}
