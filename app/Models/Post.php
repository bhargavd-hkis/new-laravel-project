<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    use HasFactory;
     public $directory = "/uploads/";

    // protected $fillable = ['title','user_id','body','post_image'];
    protected $guarded = [];

    public function user(){

        return $this->belongsTo(User::class);

    }
    

     public function getPostImageAttribute($value)
    {
        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            return $value;
        }
        return $this->directory.$value;

    }

    // public function setPostImageAttribute($value)
    // {
    //     $this->attributes['post_image']= asset($value);
    // }
    

    public function comments(){
        return $this->HasMany('App\Models\Comment');
    }

}
