<?php

namespace Modules\Contacts\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Contacts\Data\Enums\ContactTypeEnum;
use Modules\Contacts\Data\Factories\ContactFactory;
use Modules\Contacts\Data\Scopes\ContactTypeScope;

class Contact extends Model
{
    use HasFactory;
    use ContactTypeScope;

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
}
