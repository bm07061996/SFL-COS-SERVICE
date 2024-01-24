<?php
namespace App\Components;

interface ComponentFactoryInterface
{
	public function get($componentName) : object;
}