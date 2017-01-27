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

class Language extends Model
{
	protected $table = 'language';

	public $timestamps = false;

	protected $fillable = [
    'name', 'code', 'locale', 'image', 'sort_order', 'status'
  ];

  protected $hidden = [
  ];

  public function addLanguage($data){}

  public function editLanguage($language_id, $data = array()){
  	Language::where('language_id', $language_id)->update($data);
  }

	public function getLanguage($language_id) {
		$results = array();
  	$results = Language::where('language_id', $language_id)->first();
  	return $results->toArray();
	}

  public function getLanguages(){
  	$results = array();
  	$results = Language::all();
  	return $results;
  }

  public function getTotalLanguages(){
  	return Language::count();
  }
}
