<?php

namespace Modules\Accounts\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Accounts\Data\Enums\AccountStatusEnum;
use Modules\Accounts\Data\Factories\AccountFactory;
use Modules\Accounts\Data\Scopes\AccountStatusScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Contacts\Data\Models\Contact;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
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
