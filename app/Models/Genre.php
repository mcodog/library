<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Genre extends Model
{
    use HasFactory;
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function getImage(){
        if($this->img_path){
            return url('storage/'. $this->img_path);
        }
        return URL::asset('storage/genre/default-genre.png');
    }
}
