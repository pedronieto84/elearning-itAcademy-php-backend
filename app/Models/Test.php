<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Card;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'items', 'subTitle', 'cards_id'
    ];

    public function card()
    {
        return $this->belongsTo(Card::class);
    }
    
}
