<?php
namespace App\Components;

use Illuminate\Http\Request;

interface ComponentInterface
{
	public function run($action, Request $request);
}