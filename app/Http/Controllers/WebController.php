<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebRequest;
use App\Http\Services\WebService;
use Illuminate\Http\Request;
class WebController extends Controller
{
    protected $webService;

    public function __construct(WebService $webService)
    {
        $this->webService = $webService;
    }

    public function subscribe(WebRequest $request)
    {
        $this->webService->subscribe($request);
        return response()->json("success",201);
    }

}
