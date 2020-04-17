<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
        $rules = [
            'settings_key' => 'required',
            'settings_value'  =>  ''
        ];

        if ($this->settings_key == 'workers' || $this->settings_key == 'hour_price') {
            $rules['settings_value'] = 'numeric';
        }
        

        return $rules;
    }
}
