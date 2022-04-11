<?php

namespace Modules\Accounts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditAccountRequest extends FormRequest
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
            'document' => 'required|min:11|max:14',
            'name'=> 'required|min:5|max:255',
            'address' => 'required|min:3|max:255',
            'district' => 'required|min:3|max:255',
            'city' => 'required|min:3|max:255',
            'complement' => 'max:255',
            'status' => 'in:0,1,2,3,4,5,6,7'
        ];
    }
}
