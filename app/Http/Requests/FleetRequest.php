<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FleetRequest extends FormRequest
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
        switch($this->method()){
            case 'POST':
            case 'PATCH':
                return [
                    'user_id'=>'required|numeric',
                    'fleet_name'=>'required|string',
                    'status'=>'required|numeric'
                ];
            case 'GET':
            case 'DELETE':
                return[

                ];                
        }
    }
}
