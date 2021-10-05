<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Card;

class Video extends Model
{
    use HasFactory;

     protected $fillable = [
        'videoUrl', 'subTitle', 'cards_id'
    ];

    public function card()
    {
        return $this->belongsTo(Card::class);
    }

}
