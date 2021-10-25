<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

     protected $fillable = [

        'comment_id','author','email','file','is_active','body'

    ];


    public function comments(){
        return $this->belongsTo('App\Models\Comment');   
    }
}
