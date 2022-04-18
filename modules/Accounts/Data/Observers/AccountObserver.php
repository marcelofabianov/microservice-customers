<?php

namespace Modules\Accounts\Data\Observers;

use Modules\Accounts\Data\Cache\AccountCache;
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

        $author = auth()->user() ?? 0;

        activity($this->type)
            ->performedOn($account)
            ->by($author)
            ->event('created')
            ->withProperties($properties)
            ->log(EVENT_CREATED);

        $cache = new AccountCache();
        $cache->recycleCache($account, 'created');
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

        $author = auth()->user() ?? 0;

        activity($this->type)
            ->performedOn($account)
            ->by($author)
            ->event('updating')
            ->withProperties($properties)
            ->log(EVENT_UPDATING);
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

        $author = auth()->user() ?? 0;

        activity($this->type)
            ->performedOn($account)
            ->by($author)
            ->event('updated')
            ->withProperties($properties)
            ->log(EVENT_UPDATED);

        $cache = new AccountCache();
        $cache->recycleCache($account, 'updated');
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param Account $account
     * @return void
     */
    public function deleted(Account $account)
    {
        $author = auth()->user() ?? 0;

        activity($this->type)
            ->performedOn($account)
            ->by($author)
            ->event('deleted')
            ->log(EVENT_DELETED);

        $cache = new AccountCache();
        $cache->recycleCache($account, 'deleted');
    }

    /**
     * Handle the User "restored" event.
     *
     * @param Account $account
     * @return void
     */
    public function restored(Account $account)
    {
        $author = auth()->user() ?? 0;

        activity($this->type)
            ->performedOn($account)
            ->by($author)
            ->event('restored')
            ->log(EVENT_RESTORED);

        $cache = new AccountCache();
        $cache->recycleCache($account, 'restored');
    }

    /**
     * Handle the User "forceDeleted" event.
     *
     * @param Account $account
     * @return void
     */
    public function forceDeleted(Account $account)
    {
        $author = auth()->user() ?? 0;

        activity($this->type)
            ->performedOn($account)
            ->by($author)
            ->event('forceDeleted')
            ->log(EVENT_FORCE_DELETED);

        $cache = new AccountCache();
        $cache->recycleCache($account, 'forceDeleted');
    }
}
