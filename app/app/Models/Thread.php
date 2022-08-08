<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;
    protected $fillable = ["channel_id", "user_id", "title", "body", "slug"];

    public function user(){
        return $this->belongsTo("App\Models\User");
    }

    public function replies(){
        return $this->hasMany("App\Models\Reply")->orderBy("created_at", "DESC");
    }

    public function channel(){
        return $this->belongsTo("App\Models\Channel");
    }
}
