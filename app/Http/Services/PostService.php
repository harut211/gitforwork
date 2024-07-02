<?php

   namespace App\Http\Services;



   use App\Models\Post;

   class PostService{


       public function create($request){
           $post = Post::updateOrCreate([
               'web_id' => $request->web_id,
               'title' => $request->title,
               'content' => $request->content,
           ]);
           $post->save();
       }

   }
