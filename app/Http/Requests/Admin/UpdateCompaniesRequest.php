<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompaniesRequest extends FormRequest
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
            
            'company_logo' => 'nullable|mimes:png,jpg,jpeg,gif',
            'name' => 'min:3|max:255|required',
            'categories' => 'required',
            'categories.*' => 'exists:company_categories,id',
            'address' => 'min:1|max:255|required',
            'state_id' => 'required',
            'country' => 'min:3|max:255|required',
        ];
    }
}
