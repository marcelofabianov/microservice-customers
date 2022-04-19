<?php

namespace Microservice\Accounts\Data\Models;

use App\Models\ModelContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Microservice\Accounts\Data\Enums\AccountStatusEnum;
use Microservice\Accounts\Data\Factories\AccountFactory;
use Microservice\Accounts\Data\Scopes\AccountStatusScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Microservice\Contacts\Data\Models\Contact;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model implements ModelContract
{
    use AccountStatusScope;
    use HasFactory;
    use SoftDeletes;

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

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }
}
