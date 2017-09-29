<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class Modules extends Model
{
    protected $fillable = ['name', 'section', 'title', 'description', 'hidden'];
}
