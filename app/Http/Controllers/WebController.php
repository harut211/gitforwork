<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebRequest;
use App\Http\Services\WebService;
class WebController extends Controller
{
    protected $webService;

    public function __construct(WebService $webService)
    {
        $this->webService = $webService;
    }

    public function subscribe(WebRequest $request)
    {
       $massage =  $this->webService->subscribe($request);

        return response()->json($massage,201);
    }

}
