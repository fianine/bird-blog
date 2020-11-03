<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Timezone;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use Timezone;
    use SoftDeletes;
    
    protected $table = 'articles';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'author',
        'title',
        'slug',
        'image',
        'content'
    ];
}
