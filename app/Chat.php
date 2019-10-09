<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        "no_detail_chat", "id_user_from", "id_user_to"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user_form');
        return $this->belongsTo(User::class, 'id_user_to');
    }
}
