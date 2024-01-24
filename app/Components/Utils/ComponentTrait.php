<?php

namespace App\Components\Utils;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

trait ComponentTrait
{
	public function getComponentProductObject(Request $request, $products)
	{
		$product = $request->product_code;
		if (Arr::exists($products, $product) === false) {
			throw new Exception(
				sprintf("%s Component: Product code %s class not found", $request->component, $product)
			);
		}

		$productClass = $products[$product];
			
		if (empty($productClass) === true || class_exists($productClass) === false) {
			throw new Exception(
				sprintf("%s Component: Product code %s class not found", $request->component, $productClass)
			);
		}

		if (method_exists($productClass, $request->action) === false) {
			throw new Exception(
				sprintf(
					"%s Component: Product class %s method %s not found",
					$request->component,
					$productClass,
					$request->action
				)
			);
		}

		if (is_callable([$productClass, $request->action], true) === false) {
			throw new Exception(
				sprintf(
					"%s Component: Product class %s method %s is not callable.",
					$request->component,
					$productClass,
					$request->action
				)
			);
		}

		return app()->make($productClass);
	}

	public function getComponentObject(Request $request, $components)
	{		
		$component = Str::lower($request->component);
		if(Arr::exists($components,$component) === false){
			throw new Exception(
				sprintf("components: %s class not found", $component)
			);			
		}
		if(Arr::exists($request->data,'provider') === false ){
			throw new Exception("Please give a provider name");			
		}
		$provider = $request->data['provider'];
		if(Arr::exists($components[$component],$provider) === false ){
			throw new Exception("Please give a valid provider name");			
		}
		$providerClass = $components[$component][$provider];
		if(empty($providerClass) === true || class_exists($providerClass) === false){
			throw new Exception(
				sprintf("%s Component: %s class not found", $request->component, $provider)
			);
		}
		if(method_exists($providerClass, $request->action) === false){
			throw new Exception(
				sprintf(
					"%s Component: Provider class %s method %s not found", 
					$request->component, $providerClass, $request->action
				)
			);
		}

		if(is_callable([$providerClass, $request->action], true) === false){
			throw new Exception(
				sprintf(
					"%s Component: Provider class %s method %s is not callable.", 
					$request->component, $providerClass, $request->action
				)
			);
		}		

		return app()->make($providerClass);
	}
}
