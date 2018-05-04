<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
   
    public function getFillable() {
        
        return (array_diff($this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable()),['id','deleted_at','created_at','updated_at']));
    }

}