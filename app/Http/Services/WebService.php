<?php

namespace App\Http\Services;

use App\Models\Subscribe;

class WebService{

   public function subscribe($request)
   {
       $subscription = Subscribe::where('user_id',$request->user_id)
           ->where('webs_id', $request->web_id)
           ->first();

       if(!$subscription) {
           Subscribe::create([
               "user_id" => $request->user_id,
               "webs_id" => $request->web_id,
           ]);
           return "You have subscribed successfully";

       } else {
           return "You have already subscribed";
       }

   }
}
