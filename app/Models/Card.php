<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Topic;


class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'cardType', 'topics_id', 'videos_id', 'texts_id', 'listas_id', 'tests_id'
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    

}
