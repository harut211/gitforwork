<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Services\PostService;
use Illuminate\Support\Facades\App;

class PostController extends Controller
{
    protected  $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        return view('post');
    }

    public function create(PostRequest $request)
    {
        $this->postService->create($request);
        return response()->json("success",201);
    }

}

