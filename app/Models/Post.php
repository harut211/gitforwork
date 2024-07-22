<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'web_id',
        'title',
        'content'
    ];

    protected $table = 'posts';

    public function run(): void
    {
        Post::factory()
            ->count(10)
            ->create();
    }


    public function websites()
    {
        return $this->hasManyThrough(
            Website::class,
            Subscribe::class,
            'webs_id',
            'id',
            'id',
            'webs_id'
        );
    }
    public function emailLogs()
    {
        return $this->hasMany(EmailLog::class);
    }

}
