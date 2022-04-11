<?php

namespace Modules\Contacts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'account_id' => 'required',
            'description' => 'required|min:5|max:255',
            'contact' => 'required|min:5|max:255',
            'type' => 'required|in:1,2,3,4'
        ];
    }
}
