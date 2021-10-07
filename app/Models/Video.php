<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Topic;

class Video extends Model
{
    use HasFactory;

     protected $fillable = [
        'videoUrl', 'subTitle', 'topics_id'
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

}
