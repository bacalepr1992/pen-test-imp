<?php
/******************************************************
 * @package: Pen Framework
 * @author: pencms team
 * @copyright: Copyright (C) 2016 www.pencms.com. All rights reserved.
 * @license: MIT
*******************************************************/

namespace App\PenCMS\Models\Admin\Tool;
use Illuminate\Database\Eloquent\Model;

class Image extends Model {
	private $helper;
	private $request;
	public function __construct(){
		$this->helper = app('pen_helper');
		$this->request = app('pen_request');
	}
	public function resize($filename, $width, $height) {

		if (!is_file(DIR_MEDIA . $filename) || substr(str_replace('\\', '/', realpath(DIR_MEDIA. $filename)), 0, strlen(DIR_MEDIA)) != str_replace('\\', '/', DIR_MEDIA)) {
			return;
		}

		$extension = pathinfo($filename, PATHINFO_EXTENSION);

		$image_old = $filename;
		$image_new = 'cache/' . $this->helper->utf8_substr($filename, 0, $this->helper->utf8_strrpos($filename, '.')) . '-' . $width . 'x' . $height . '.' . $extension;

		if (!is_file(DIR_MEDIA . $image_new) || (filectime(DIR_MEDIA . $image_old) > filectime(DIR_MEDIA . $image_new))) {
			list($width_orig, $height_orig, $image_type) = getimagesize(DIR_MEDIA . $image_old);

			if (!in_array($image_type, array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF))) {
				return DIR_MEDIA . $image_old;
			}

			$path = '';

			$directories = explode('/', dirname($image_new));

			foreach ($directories as $directory) {
				$path = $path . '/' . $directory;

				if (!is_dir(DIR_MEDIA . $path)) {
					@mkdir(DIR_MEDIA . $path, 0777);
				}
			}

			if ($width_orig != $width || $height_orig != $height) {
				$image = new \PenFramework\Library\Image(DIR_MEDIA . $image_old);
				$image->resize($width, $height);
				$image->save(DIR_MEDIA . $image_new);
			} else {
				copy(DIR_MEDIA . $image_old, DIR_MEDIA . $image_new);
			}
		}

		return asset('PenCMS/Media/' . $image_new);
	}
}
