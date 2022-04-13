<?php

namespace Modules\Contacts\Data\Observers;

use Modules\Contacts\Data\Models\Contact;

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

        activity($this->type)
            ->performedOn($contact)
            ->by(auth()->user())
            ->event('created')
            ->withProperties($properties)
            ->log(EVENT_CREATED);
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

        activity($this->type)
            ->performedOn($contact)
            ->by(auth()->user())
            ->event('updating')
            ->withProperties($properties)
            ->log(EVENT_UPDATING);
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

        activity($this->type)
            ->performedOn($contact)
            ->by(auth()->user())
            ->event('updated')
            ->withProperties($properties)
            ->log(EVENT_UPDATED);
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param Contact $contact
     * @return void
     */
    public function deleted(Contact $contact)
    {
        activity($this->type)
            ->performedOn($contact)
            ->by(auth()->user())
            ->event('deleted')
            ->log(EVENT_DELETED);
    }

    /**
     * Handle the User "restored" event.
     *
     * @param Contact $contact
     * @return void
     */
    public function restored(Contact $contact)
    {
        activity($this->type)
            ->performedOn($contact)
            ->by(auth()->user())
            ->event('restored')
            ->log(EVENT_RESTORED);
    }

    /**
     * Handle the User "forceDeleted" event.
     *
     * @param Contact $contact
     * @return void
     */
    public function forceDeleted(Contact $contact)
    {
        activity($this->type)
            ->performedOn($contact)
            ->by(auth()->user())
            ->event('forceDeleted')
            ->log(EVENT_FORCE_DELETED);
    }
}
