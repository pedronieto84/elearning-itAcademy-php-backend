<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Topic;

class Lista extends Model
{
    use HasFactory;

    
     protected $fillable = [
        'items', 'subTitle', 'topics_id'
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
