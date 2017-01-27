<?php
/******************************************************
 * @package: Pen Framework
 * @author: pencms team
 * @copyright: Copyright (C) 2016 www.pencms.com. All rights reserved.
 * @license: MIT
*******************************************************/

namespace App\PenCMS\Models\Admin\User;

use DB;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	protected $table = 'user';

	protected $primaryKey = 'user_id';

	protected $fillable = [
    'fullname', 'email', 'password', 'created_at', 'updated_at', 'user_group_id'
  ];

  protected $hidden = [
    'remember_token',
  ];

  public $default_data = [
  	'fullname' => '',
  	'email' => '',
  	'user_group_id' => '',
  	'password' => ''
  ];

  public function addUser($data = array()){
  	User::create([
  		'fullname' => $data['fullname'],
  		'email' => $data['email'],
  		'user_group_id' => $data['user_group_id'],
  		'password' => bcrypt($data['password']),
  	]);
  }

  public function editUser($user_id, $data = array()){
  	User::where('user_id', $user_id)->update($data);
  }

  public function deleteUser(){}

	public function getUser($user_id){
  	$query = User::where('user_id', $user_id)->first();
  	return $query;
	}

  public function getUsers($data = array()){
  	$query = DB::table('user');

  	$sort_data = array(
			'fullname',
			'email'
		);

  	if(isset($data['sort']) && isset($data['order']) && in_array($data['sort'], $sort_data)){
  		$query->orderBy($data['sort'], $data['order']);
  	} elseif(isset($data['sort']) && in_array($data['sort'], $sort_data)) {
  		$query->orderBy($data['sort']);
  	} else{
  		$query->orderBy('fullname', 'ASC');
  	}

  	if (isset($data['start']) || isset($data['limit'])) {
  		if($data['start'] < 0){
  			$data['start'] = 0;
  		}

  		if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$query->offset($data['start'])->limit($data['limit']);
  	}

  	return $query->get();
  }

  public function getTotalUsers(){
  	return User::count();
  }
}
