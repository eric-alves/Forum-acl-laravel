<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'descricao', 'slug'];

    public function threads(){
        return $this->hasMany("App\Models\Thread")->orderBy("created_at", "DESC");
    }
}
