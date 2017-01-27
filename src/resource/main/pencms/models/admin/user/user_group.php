<?php
/******************************************************
 * @package: Pen Framework
 * @author: pencms team
 * @copyright: Copyright (C) 2016 www.pencms.com. All rights reserved.
 * @license: MIT
*******************************************************/

namespace App\PenCMS\Models\Admin\User;

use DB;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model {
	protected $table = 'user_group';

	public $timestamps = false;

	protected $fillable = [
        'name', 'description', 'permission',
    ];

  protected $hidden = [
  ];

  public function addUserGroup($data = array()){
  	UserGroup::create([
  		'name' => $data['name'],
  		'description' => $data['description'],
  		'permission' => isset($data['permission']) ? json_encode($data['permission']) : ''
  	]);
  }

  public function editUserGroup($user_group_id, $data) {
  	UserGroup::where('user_group_id', $user_group_id)->update([
  		'name' => $data['name'],
  		'description' => $data['description'],
  		'permission' => json_encode($data['permission'], true)
  	]);
	}

	public function deleteUserGroup($data = array()){
		foreach ($data as $user_group_id) {
			UserGroup::where('user_group_id', $user_group_id)->delete();
		}
	}

	public function getUserGroup($user_group_id){
		$user_group = array();
    	$user_group = UserGroup::where('user_group_id', $user_group_id)->first();
    	return $user_group->toArray();
	}

  public function getUserGroups(){
  	$user_groups = array();
  	$user_groups = UserGroup::all();
  	return $user_groups->toArray();
  }
}
