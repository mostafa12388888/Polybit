<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatalogRequest extends Model
{
    protected $guarded = [];

    public function catalog()
    {
        return $this->belongsTo(Catalog::class);
    }
}
