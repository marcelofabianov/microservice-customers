<?php

namespace Microservice\CustomerPipelines\Data\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerPipeline extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'label',
        'value'
    ];

    protected static function newFactory(): CustomerPipeline
    {
        return new CustomerPipeline();
    }
}
