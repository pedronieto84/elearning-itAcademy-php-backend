<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Video;
use App\Models\Test;
use App\Models\Text;
use App\Models\Lista;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'position', 'topics_id'
    ];

    public function video()
    {
        return $this->hasOne(Video::class);
    }
    
    public function text()
    {
        return $this->hasOne(Text::class);
    }
    public function test()
    {
        return $this->hasOne(Test::class);
    }

    public function lista()
    {
        return $this->hasOne(Lista::class);
    }
    
}
