<?php

namespace Microservice\Accounts\Data\Observers;

use App\Messages\EventEnum;
use Microservice\Accounts\Data\Cache\AccountCache;
use Microservice\Accounts\Data\Models\Account;
use Microservice\Accounts\Data\Queue\AccountQueue;

class AccountObserver
{
    /**
     * @var string
     */
    private string $type = 'Accounts';

    /**
     * @var string
     */
    private string $connection = 'rabbitmq';

    /**
     * @var string
     */
    private string $queue = 'Accounts';

    /**
     * @param array $properties
     * @return void
     */
    private function dispatch(array $properties)
    {
        if (env('QUEUE_RABBITMQ', false)) {
            AccountQueue::dispatch(json_encode($properties))
                ->onConnection($this->connection)
                ->onQueue($this->queue);
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

        $author = auth()->check() ? auth()->user() : null;

        activity($this->type)
            ->performedOn($account)
            ->by($author)
            ->event('created')
            ->withProperties($properties)
            ->log(EventEnum::EVENT_CREATED->value);

        $cache = new AccountCache();
        $cache->recycle($account, 'created');

        $this->dispatch($properties);
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

        $cache = new AccountCache();
        $cache->recycle($account, 'updated');

        $this->dispatch($properties);
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param Account $account
     * @return void
     */
    public function deleted(Account $account)
    {
        $properties = [
            'type' => $this->type,
            'action' => 'deleted',
            'done' => $account->toArray()
        ];

        $author = auth()->check() ? auth()->user() : null;

        activity($this->type)
            ->performedOn($account)
            ->by($author)
            ->event('deleted')
            ->log(EventEnum::EVENT_DELETED->value);

        $cache = new AccountCache();
        $cache->recycle($account, 'deleted');

        $this->dispatch($properties);
    }

    /**
     * Handle the User "restored" event.
     *
     * @param Account $account
     * @return void
     */
    public function restored(Account $account)
    {
        $properties = [
            'type' => $this->type,
            'action' => 'deleted',
            'done' => $account->toArray()
        ];

        $author = auth()->check() ? auth()->user() : null;

        activity($this->type)
            ->performedOn($account)
            ->by($author)
            ->event('restored')
            ->log(EventEnum::EVENT_RESTORED->value);

        $cache = new AccountCache();
        $cache->recycle($account, 'restored');

        $this->dispatch($properties);
    }

    /**
     * Handle the User "forceDeleted" event.
     *
     * @param Account $account
     * @return void
     */
    public function forceDeleted(Account $account)
    {
        $properties = [
            'type' => $this->type,
            'action' => 'deleted',
            'done' => $account->toArray()
        ];

        $author = auth()->check() ? auth()->user() : null;

        activity($this->type)
            ->performedOn($account)
            ->by($author)
            ->event('forceDeleted')
            ->log(EventEnum::EVENT_FORCE_DELETED->value);

        $cache = new AccountCache();
        $cache->recycle($account, 'forceDeleted');

        $this->dispatch($properties);
    }
}
