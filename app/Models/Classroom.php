<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model 
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $table = 'classerooms';
    public $timestamps = true;
    protected $fillable = ['id', 'name', 'notes', 'grade_id'];

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade', 'grade_id');
    }

}