<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, BelongsToTenant;

    protected $fillable = ['name', 'price', 'tenant_id'];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
