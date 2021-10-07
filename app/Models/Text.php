<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Topic;

class Text extends Model
{
    use HasFactory;

    protected $fillable = [
        'text', 'topics_id'
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
