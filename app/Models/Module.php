<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Topic;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'imaginUrl', 'route', 'topics_id'
    ];

    public function topic()
    {
        return $this->hasMany(Topic::class);
    }
}
