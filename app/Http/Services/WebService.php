<?php
    namespace App\Http\Services;

    use App\Models\Subscribe;

    class WebService{

        public function subscribe($request){
            Subscribe::updateOrCreate([
                "user_id" => $request->user_id,
                "webs_id" => $request->web_id,
            ]);
        }
    }
