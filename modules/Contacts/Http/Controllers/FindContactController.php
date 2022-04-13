<?php

namespace Modules\Contacts\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Contacts\Data\Models\Contact;
use Modules\Contacts\Http\Resources\ContactResource;

class FindContactController extends Controller
{
    /**
     * @param int $id
     * @return ContactResource
     */
    public function handle(int $id): ContactResource
    {
        return new ContactResource(Contact::findOrFail($id));
    }
}
