<?php
namespace App\Components;

use App\Utils\HelperTrait;
use Illuminate\Http\Request;
use App\Utils\RestServiceTrait;
use App\Components\Utils\ComponentTrait;
use App\Components\ComponentInterface;

abstract class Component implements ComponentInterface
{
	use RestServiceTrait, HelperTrait,ComponentTrait;

	abstract public function execute($action, Request $request);

	abstract public function getComponentName();

	public function run($action, Request $request)
	{
		$componentName = $this->getComponentName();
		return $this->execute($action, $request);
	}
}