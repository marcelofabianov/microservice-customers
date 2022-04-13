<?php

namespace Modules\Contacts\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Contacts\Data\Models\Contact;

class DestroyContactController extends Controller
{
    public function handle(int $id)
    {
        $contact = Contact::find($id);
        $contact->delete();

        return response([], 200);
    }
}
