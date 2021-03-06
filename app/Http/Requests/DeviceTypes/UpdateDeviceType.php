<?php

namespace App\Http\Requests\DeviceTypes;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeviceType extends FormRequest
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
            'device_type' => 'required|string|max:190'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'device_type' => trans_choice('device-types.device_type', 1),
        ];
    }
}
