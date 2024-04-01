<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Author extends Model
{
    use HasFactory;
    //$timestamps = false;
    protected $fillable = ['name', 'gender', 'age'];

    public function getImage(){
        if($this->img_path){
            return url('storage/'. $this->img_path);
        }
        return URL::asset('storage/author/default-author.png');
    }

    public function books()
{
    return $this->hasMany(Book::class);
}

}


