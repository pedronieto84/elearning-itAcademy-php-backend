<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Topic;
use App\Models\Video;
use App\Models\Test;
use App\Models\Text;
use App\Models\Lista;

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

    public function video()
    {
        return $this->hasMany(Video::class);
    }
    
    public function text()
    {
        return $this->hasMany(Text::class);
    }
    public function test()
    {
        return $this->hasMany(Test::class);
    }

    public function lista()
    {
        return $this->hasMany(Lista::class);
    }

}
