<?php

namespace App\Services\V1;

use App\Component\PostLogin\PostLoginFactory;
use App\Components\ComponentFactoryInterface;
use App\Services\BaseService;
use App\Utils\RestServiceTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;


class PostLoginService extends BaseService
{    
    use RestServiceTrait;


    public function run(Request $request,ComponentFactoryInterface $componentFactory)
    {

        $type = Arr::exists($request->all(), 'component') === true ? 'component' : '';
        $serviceObj = $componentFactory->get($request->component);
        if (Str::is($type, 'module') === false) {
            return  $serviceObj->run($request->action, $request);
        }
        return  $serviceObj->run($request);
    }
}