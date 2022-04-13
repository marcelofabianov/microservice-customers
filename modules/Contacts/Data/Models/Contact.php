<?php

namespace Modules\Contacts\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Accounts\Data\Models\Account;
use Modules\Contacts\Data\Enums\ContactTypeEnum;
use Modules\Contacts\Data\Factories\ContactFactory;
use Modules\Contacts\Data\Scopes\ContactTypeScope;
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
