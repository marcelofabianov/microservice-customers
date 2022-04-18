<?php

namespace Modules\Accounts\Data\Observers;

use App\Messages\EventEnum;
use Modules\Accounts\Data\Models\Account;

class AccountObserver
{
    /**
     * @var string
     */
    private string $type = 'Accounts';

    /**
     * Handle the User "created" event.
     *
     * @param Account $account
     * @return void
     */
    public function created(Account $account)
    {
        $properties = [
            'type' => $this->type,
            'action' => 'created',
            'done' => $account->toArray()
        ];

        $author = auth()->check() ? auth()->user() : null;

        activity($this->type)
            ->performedOn($account)
            ->by($author)
            ->event('created')
            ->withProperties($properties)
            ->log(EventEnum::EVENT_CREATED->value);

        //$cache = new AccountCache();
        //$cache->recycleCache($account, 'created');
    }

    /**
     * Handle the User "created" event.
     *
     * @param Account $account
     * @return void
     */
    public function updating(Account $account)
    {
        $properties = [
            'type' => $this->type,
            'action' => 'updating',
            'before' => $account->getRawOriginal(),
            'after' => $account->toArray()
        ];

        $author = auth()->check() ? auth()->user() : null;

        activity($this->type)
            ->performedOn($account)
            ->by($author)
            ->event('updating')
            ->withProperties($properties)
            ->log(EventEnum::EVENT_UPDATING->value);
    }

    /**
     * Handle the User "updated" event.
     *
     * @param Account $account
     * @return void
     */
    public function updated(Account $account)
    {
        $properties = [
            'type' => $this->type,
            'action' => 'updated',
            'done' => $account->toArray()
        ];

        $author = auth()->check() ? auth()->user() : null;

        activity($this->type)
            ->performedOn($account)
            ->by($author)
            ->event('updated')
            ->withProperties($properties)
            ->log(EventEnum::EVENT_UPDATED->value);

        //$cache = new AccountCache();
        //$cache->recycleCache($account, 'updated');
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param Account $account
     * @return void
     */
    public function deleted(Account $account)
    {
        $author = auth()->check() ? auth()->user() : null;

        activity($this->type)
            ->performedOn($account)
            ->by($author)
            ->event('deleted')
            ->log(EventEnum::EVENT_DELETED->value);

        //$cache = new AccountCache();
        //$cache->recycleCache($account, 'deleted');
    }

    /**
     * Handle the User "restored" event.
     *
     * @param Account $account
     * @return void
     */
    public function restored(Account $account)
    {
        $author = auth()->check() ? auth()->user() : null;

        activity($this->type)
            ->performedOn($account)
            ->by($author)
            ->event('restored')
            ->log(EventEnum::EVENT_RESTORED->value);

        //$cache = new AccountCache();
        //$cache->recycleCache($account, 'restored');
    }

    /**
     * Handle the User "forceDeleted" event.
     *
     * @param Account $account
     * @return void
     */
    public function forceDeleted(Account $account)
    {
        $author = auth()->check() ? auth()->user() : null;

        activity($this->type)
            ->performedOn($account)
            ->by($author)
            ->event('forceDeleted')
            ->log(EventEnum::EVENT_FORCE_DELETED->value);

        //$cache = new AccountCache();
        //$cache->recycleCache($account, 'forceDeleted');
    }
}
