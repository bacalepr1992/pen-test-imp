<?php
/******************************************************
 * @package: Pen Framework
 * @author: pencms team
 * @copyright: Copyright (C) 2016 www.pencms.com. All rights reserved.
 * @license: MIT
*******************************************************/

namespace App\PenCMS\Models\Admin\Setting;

use DB;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	protected $table = 'setting';

	public $timestamps = false;

	protected $fillable = [
		'code', 'key', 'value', 'serialized'
  ];

  protected $hidden = [
  ];

  public $default_data = [
  	'config_meta_title' => 'PenCMS',
  	'config_meta_description' => 'PenCMS - Opensource CMS Base On Laravel',
  	'config_meta_keyword' => 'PenCMS - Opensource CMS Base On Laravel',
  	'config_email' => 'contact@pencms.com',
  	'config_phone' => '+84 12345679',
  	'config_limit_admin' => 15,
  	'config_admin_template' => 'admin_lte'
  ];

  public function getSetting($code) {
		$setting_data = array();

		$query = Setting::where('code', $code)->get();

		foreach ($query as $result) {
			if (!$result->serialized) {
				$setting_data[$result->key] = $result->value;
			} else {
				$setting_data[$result->key] = json_decode($result->value, true);
			}
		}

		return $setting_data;
	}

	public function editSetting($code, $data) {
		Setting::where('code', $code)->delete();
		foreach ($data as $key => $value) {
			if (substr($key, 0, strlen($code)) == $code) {
				if (!is_array($value)) {
					Setting::create([
						'code' => $code,
						'key' => $key,
						'value' => $value,
						'serialized' => 0
					]);
				} else {
					Setting::create([
						'code' => $code,
						'key' => $key,
						'value' => json_encode($value, true),
						'serialized' => 1
					]);
				}
			}
		}
	}
}
