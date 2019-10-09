<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailChat extends Model
{
    protected $fillable =[
        "no_detail_chat", "id_user_form", "id_user_to", "chat", "status"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user_form');
        return $this->belongsTo(User::class, 'id_user_to');
    }
}
