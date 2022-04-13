<?php

namespace Modules\Accounts\Data\Observers;

use Modules\Accounts\Data\Models\Account;

class AccountObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param Account $account
     * @return void
     */
    public function created(Account $account)
    {
        $properties = [
            'type' => 'Account',
            'action' => 'created',
            'done' => $account->toArray()
        ];

        activity('Account')
            ->performedOn($account)
            ->by(auth()->user())
            ->event('created')
            ->withProperties($properties)
            ->log(EVENT_CREATED);
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
            'type' => 'Account',
            'action' => 'updating',
            'before' => $account->getRawOriginal(),
            'after' => $account->toArray()
        ];

        activity('Account')
            ->performedOn($account)
            ->by(auth()->user())
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
            'type' => 'Account',
            'action' => 'updated',
            'done' => $account->toArray()
        ];

        activity('Account')
            ->performedOn($account)
            ->by(auth()->user())
            ->event('updated')
            ->withProperties($properties)
            ->log(EVENT_UPDATED);
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param Account $account
     * @return void
     */
    public function deleted(Account $account)
    {
        activity('Account')
            ->performedOn($account)
            ->by(auth()->user())
            ->event('deleted')
            ->log(EVENT_DELETED);
    }

    /**
     * Handle the User "restored" event.
     *
     * @param Account $account
     * @return void
     */
    public function restored(Account $account)
    {
        activity('Account')
            ->performedOn($account)
            ->by(auth()->user())
            ->event('restored')
            ->log(EVENT_RESTORED);
    }

    /**
     * Handle the User "forceDeleted" event.
     *
     * @param Account $account
     * @return void
     */
    public function forceDeleted(Account $account)
    {
        activity('Account')
            ->performedOn($account)
            ->by(auth()->user())
            ->event('forceDeleted')
            ->log(EVENT_FORCE_DELETED);
    }
}
