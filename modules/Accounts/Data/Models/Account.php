<?php

namespace Modules\Accounts\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Accounts\Data\Enums\AccountStatusEnum;
use Modules\Accounts\Data\Factories\AccountFactory;
use Modules\Accounts\Data\Scopes\AccountStatusScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Model
{
    use AccountStatusScope;
    use HasFactory;

    protected $fillable = [
        'document',
        'name',
        'address',
        'district',
        'city',
        'complement',
        'status',
    ];

    protected $casts = [
        'status' => AccountStatusEnum::class,
    ];

    protected static function newFactory(): AccountFactory
    {
        return new AccountFactory;
    }
}
