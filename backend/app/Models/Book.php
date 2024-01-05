<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'tbl_book';
    public $timestamps = false;

    public function publisher(){
        return $this->belongsTo(Publisher::class,'publisher_id','idx');
    }

    public function author(){
        return $this->belongsTo(ContentOwner::class,'co_id','idx');
    }
}
