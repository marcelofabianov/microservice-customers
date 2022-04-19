<?php

namespace Microservice\Contacts\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Microservice\Accounts\Data\Models\Account;
use Microservice\Contacts\Data\Enums\ContactTypeEnum;
use Microservice\Contacts\Data\Factories\ContactFactory;
use Microservice\Contacts\Data\Scopes\ContactTypeScope;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory;
    use ContactTypeScope;
    use SoftDeletes;

    protected $fillable = [
        'account_id',
        'description',
        'contact',
        'type'
    ];

    protected $casts = [
        'type' => ContactTypeEnum::class
    ];

    protected static function newFactory(): ContactFactory
    {
        return new ContactFactory;
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
