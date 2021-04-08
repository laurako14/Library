<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function bookAuthor()
   {
       return $this->belongsTo('App\Models\Author', 'author_id', 'id');
   }

   public function bookPublisher()
   {
       return $this->belongsTo('App\Models\Publisher', 'publisher_id', 'id');
   }
}
