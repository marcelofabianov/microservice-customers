<?php

namespace Modules\Accounts\Data\Observers;

use Illuminate\Support\Facades\Cache;
use Modules\Accounts\Data\Models\Account;

class AccountObserver
{
    /**
     * @var string
     */
    private string $type = 'Accounts';

    /**
     * @var string[]
     */
    private array $cacheKey = ['accounts'];

    /**
     * Clear all cache Account
     *
     * @return void
     */
    private function cacheForgetAll()
    {
        foreach ($this->cacheKey as $key) {
            Cache::forget($key);
        }
    }

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

        activity($this->type)
            ->performedOn($account)
            ->by(auth()->user())
            ->event('created')
            ->withProperties($properties)
            ->log(EVENT_CREATED);

        $this->cacheForgetAll();
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

        activity($this->type)
            ->performedOn($account)
            ->by(auth()->user())
            ->event('updating')
            ->withProperties($properties)
            ->log(EVENT_UPDATING);

        $this->cacheForgetAll();
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

        activity($this->type)
            ->performedOn($account)
            ->by(auth()->user())
            ->event('updated')
            ->withProperties($properties)
            ->log(EVENT_UPDATED);

        $this->cacheForgetAll();
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param Account $account
     * @return void
     */
    public function deleted(Account $account)
    {
        activity($this->type)
            ->performedOn($account)
            ->by(auth()->user())
            ->event('deleted')
            ->log(EVENT_DELETED);

        $this->cacheForgetAll();
    }

    /**
     * Handle the User "restored" event.
     *
     * @param Account $account
     * @return void
     */
    public function restored(Account $account)
    {
        activity($this->type)
            ->performedOn($account)
            ->by(auth()->user())
            ->event('restored')
            ->log(EVENT_RESTORED);

        $this->cacheForgetAll();
    }

    /**
     * Handle the User "forceDeleted" event.
     *
     * @param Account $account
     * @return void
     */
    public function forceDeleted(Account $account)
    {
        activity($this->type)
            ->performedOn($account)
            ->by(auth()->user())
            ->event('forceDeleted')
            ->log(EVENT_FORCE_DELETED);

        $this->cacheForgetAll();
    }
}
