<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $table = "websites";


    public function subscribes()
    {
        return $this->hasMany(Subscribe::class, 'webs_id');
    }
}
