<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Stock extends Model
{
    use HasFactory;

    public $table = 'stocks'; 

    public function book()
    {
        return $this->belongsTo(Book::class);
    }  

    public function getImage(){
        if($this->img_path){
            return url('storage/'. $this->img_path);
        }
        return URL::asset('storage/stock/default-stock.png');
    }
}
