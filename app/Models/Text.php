<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    use HasFactory;

    protected $fillable = [
        'text', 'cards_id'
    ];

    public function card()
    {
        return $this->belongsTo(Card::class);
    }
}
