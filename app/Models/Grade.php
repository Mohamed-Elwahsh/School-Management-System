<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model 
{
    use HasTranslations;

    public $translatable = ['name'];
    protected $table = 'grades';
    protected $fillable = [
        'name', 'notes', 'created_at','updated_at'
    ];
    public $timestamps = true;
    
    public function classrooms()
    {
        return $this->hasMany('App\Models\Classroom', 'grade_id');
    }
    public function sections()
    {
        return $this->hasMany('App\Models\Section', 'grade_id');
    }

}