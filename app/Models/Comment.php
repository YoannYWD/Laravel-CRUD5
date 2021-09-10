<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'user_id',
        'destination_id'
    ];

    //Cardinalité
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function destination() {
        return $this->belongsTo(Destination::class);
    }

}
