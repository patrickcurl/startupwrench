<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GrahamCampbell\GitHub\Facades\GitHub as GH;
class Github extends Model
{
    //
	public function test(){
		return GH::repo()->contents()->show('GrahamCampbell', 'Laravel-GitHub', '/', 'master');
	}
}
