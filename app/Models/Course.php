<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Module;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'imaginUrl', 'route', 'users_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function module()
    {
        return $this->hasMany(Module::class);
    }

}
