<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function SectionProduct()
    {
        return $this->hasMany(SectionProduct::class);
    }
}
