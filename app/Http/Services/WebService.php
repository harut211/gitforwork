<?php

namespace App\Http\Services;

use App\Models\Subscribe;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class WebService
{

    public function subscribe($request)
    {
        try {
            $subscription = Subscribe::where('user_id', $request->user_id)
                ->where('webs_id', $request->web_id)
                ->firstOrFail();
            return "You have already subscribed";

        } catch (ModelNotFoundException $e) {
            Subscribe::create([
                "user_id" => $request->user_id,
                "webs_id" => $request->web_id,
            ]);
            return "You have subscribed successfully";
        }
    }
}
