<?php

namespace App\Services;

use App\Services\ImageUpload\AbstractImageUploader;
use App\Services\ImageUpload\Strategy\IUploadStrategy;

class SiteSettingImageUploader extends AbstractImageUploader
{
    const FULL_IMG_FOLDER = "/uploads/site-settings/full/";

    const THUMB_IMG_FOLDER = "/uploads/site-settings/thumb/";

    const CROP_IMG_FOLDER = "/uploads/site-settings/crop/";

    const SMALL_IMG_FOLDER = "/uploads/site-settings/small/";

    const MODIFIED_FOLDER = "/uploads/site-settings/modified/";

    const MOBILE_FOLDER = "/uploads/site-settings/mobile/";

    const RES_HEIGHT = NULL;

    const RES_WIDTH = 1200;

    const THB_HEIGHT = NULL;

    const THB_WIDTH = 70;

    const SM_HEIGHT = NULL;

    const SM_WIDTH = 480;

    protected $aspectRatioStrategy;

    /**
     * BannerImageUploader constructor.
     * @param IUploadStrategy|null $strategy
     */
    public function __construct(IUploadStrategy $strategy = null)
    {
        $this->aspectRatioStrategy = $strategy;

        $this->fullImageFolder = self::FULL_IMG_FOLDER;

        $this->thumbImageFolder = self::THUMB_IMG_FOLDER;

        $this->croppedImageFolder = self::CROP_IMG_FOLDER;

        $this->modifiedImageFolder = self::MODIFIED_FOLDER;

        $this->mobileImageFolder = self::MOBILE_FOLDER;

        $this->resWidth = self::RES_WIDTH;

        $this->resHeight = self::RES_HEIGHT;

        $this->thbHeight = self::THB_HEIGHT;

        $this->thbWidth = self::THB_WIDTH;

        $this->smHeight = self::SM_HEIGHT;

        $this->smWidth = self::SM_WIDTH;
    }

    /**
     * @param $fullImage
     * @param $imagePath
     * @param $posX1
     * @param $posY1
     * @param $width
     * @param $height
     */
    public function cropAndSaveImage($fullImage, $imagePath, $posX1, $posY1, $width, $height)
    {
        $this->aspectRatioStrategy
            ->cropAndSaveImage(
                $fullImage,
                $imagePath,
                $posX1,
                $posY1,
                $width,
                $height,
                $this->resWidth,
                $this->resHeight
            );
    }
}
