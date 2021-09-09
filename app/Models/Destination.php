<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'place',
        'image',
        'text',
        'user_id'
    ];


    //Cardinalité
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
