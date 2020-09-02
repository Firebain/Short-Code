<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $fillable = ["title", "body", "page_uid"];
}
