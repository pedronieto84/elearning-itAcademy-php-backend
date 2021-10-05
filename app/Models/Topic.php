<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Card;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'position', 'cards_id'
    ];

    public function card()
    {
        return $this->hasMany(Card::class);
    }
    
}
