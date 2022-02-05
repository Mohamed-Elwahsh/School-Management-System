<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model 
{
    use HasTranslations;

    public $translatable = ['name'];
    protected $table = 'sections';
    protected $fillable = ['name', 'grade_id', 'class_id'];
    public $timestamps = true;

    public function classroom()
    {
        return $this->belongsTo('Classroom', 'class_id');
    }

}