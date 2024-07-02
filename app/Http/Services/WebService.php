<?php
    namespace App\Http\Services;

    use App\Models\Post;
    use App\Models\Subscribe;
    use App\Models\User;
    use App\Models\Web;
    use Illuminate\Support\Facades\Mail;

    class WebService{

        public function subscribe($request){
            Subscribe::updateOrCreate([
                "user_id" => $request->user_id,
                "webs_id" => $request->web_id,
            ]);
        }
    }
