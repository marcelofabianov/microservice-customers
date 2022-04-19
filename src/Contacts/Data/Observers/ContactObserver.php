<?php

namespace Microservice\Contacts\Data\Observers;

use App\Messages\EventEnum;
use Microservice\Contacts\Data\Models\Contact;

class ContactObserver
{
    /**
     * @var string
     */
    private string $type = 'Contacts';

    /**
     * Handle the User "created" event.
     *
     * @param Contact $contact
     * @return void
     */
    public function created(Contact $contact)
    {
        $properties = [
            'type' => $this->type,
            'action' => 'created',
            'done' => $contact->toArray()
        ];

        $author = auth()->check() ? auth()->user() : null;

        activity($this->type)
            ->performedOn($contact)
            ->by($author)
            ->event('created')
            ->withProperties($properties)
            ->log(EventEnum::EVENT_CREATED->value);
    }

    /**
     * Handle the User "created" event.
     *
     * @param Contact $contact
     * @return void
     */
    public function updating(Contact $contact)
    {
        $properties = [
            'type' => $this->type,
            'action' => 'updating',
            'before' => $contact->getRawOriginal(),
            'after' => $contact->toArray()
        ];

        $author = auth()->check() ? auth()->user() : null;

        activity($this->type)
            ->performedOn($contact)
            ->by($author)
            ->event('updating')
            ->withProperties($properties)
            ->log(EventEnum::EVENT_UPDATING->value);
    }

    /**
     * Handle the User "updated" event.
     *
     * @param Contact $contact
     * @return void
     */
    public function updated(Contact $contact)
    {
        $properties = [
            'type' => $this->type,
            'action' => 'updated',
            'done' => $contact->toArray()
        ];

        $author = auth()->check() ? auth()->user() : null;

        activity($this->type)
            ->performedOn($contact)
            ->by($author)
            ->event('updated')
            ->withProperties($properties)
            ->log(EventEnum::EVENT_UPDATED->value);
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param Contact $contact
     * @return void
     */
    public function deleted(Contact $contact)
    {
        $author = auth()->check() ? auth()->user() : null;

        activity($this->type)
            ->performedOn($contact)
            ->by($author)
            ->event('deleted')
            ->log(EventEnum::EVENT_DELETED->value);
    }

    /**
     * Handle the User "restored" event.
     *
     * @param Contact $contact
     * @return void
     */
    public function restored(Contact $contact)
    {
        $author = auth()->check() ? auth()->user() : null;

        activity($this->type)
            ->performedOn($contact)
            ->by($author)
            ->event('restored')
            ->log(EventEnum::EVENT_RESTORED->value);
    }

    /**
     * Handle the User "forceDeleted" event.
     *
     * @param Contact $contact
     * @return void
     */
    public function forceDeleted(Contact $contact)
    {
        $author = auth()->check() ? auth()->user() : null;

        activity($this->type)
            ->performedOn($contact)
            ->by($author)
            ->event('forceDeleted')
            ->log(EventEnum::EVENT_FORCE_DELETED->value);
    }
}
