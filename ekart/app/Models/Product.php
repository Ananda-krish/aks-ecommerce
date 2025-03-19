<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Attribute as NodeAttribute;

class Product extends Model
{
    use HasFactory;
  protected $guarded=[];

    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }

   public function getStatusTextAttribute(){
    return ($this->status ==1)?"Active":"Inactive";
   }
   public function getIsFavourateTextAttribute(){
    return ($this->is_favourate ==1)?"Yes":"No";
   }
   protected $appends =['status_text','is_favourate_text'];

    }

