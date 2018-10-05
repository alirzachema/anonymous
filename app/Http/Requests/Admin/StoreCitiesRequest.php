<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCitiesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'min:3|max:255|required',
            'companies.*.name' => 'min:3|max:255|required',
            'companies.*.address' => 'min:1|max:255|required',
            'companies.*.country' => 'min:3|max:255|required',
        ];
    }
}
