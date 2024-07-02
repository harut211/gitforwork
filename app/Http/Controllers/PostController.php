<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Services\PostService;

class PostController extends Controller
{
    protected  $postService;


    public function index(){
        return view('post');
    }

        public function __construct(PostService $postService){
        $this->postService = $postService;
    }


    public function create(PostRequest $request)
    {
        $this->postService->create($request);
        return response()->json("success",201);
    }


}

