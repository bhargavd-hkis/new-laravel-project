<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = "comments"; 

    protected $fillable = [

        'post_id','author','email','file','is_active','body'

    ];


    public function replies(){
        return $this->hasMany('App\Models\Reply');   
    }

    public function post(){
        return $this->belongsTo('App\Models\Post');
    }

}
