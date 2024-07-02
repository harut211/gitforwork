<?php

namespace App\Models;

use Database\Seeders\WebSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Web extends Model
{
    use HasFactory;

    protected $fillable = [
        "name"
    ];


    protected $table = "web";

    public function run(): void
    {
        Web::factory()
            ->count(10)
            ->create();
    }
}
