<?php
namespace App\Components;

use App\Components\ComponentFactoryInterface;
use App\Exceptions\ComponentNotFoundException;

class ComponentFactory implements ComponentFactoryInterface
{
	public function get($component) : object
	{
		$componentClass = config('components.'.$component);
		if(empty($componentClass) === true || class_exists($componentClass) === false){
			throw new ComponentNotFoundException("Component: Undefined component ".$component);
		}

		return app()->make($componentClass);
	}
}