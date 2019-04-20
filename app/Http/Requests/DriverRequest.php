<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverRequest extends FormRequest
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
                return [
                    'user_id'=>'required|numeric',
                    'driver_name'=>'required|string',
                    'sex'=>'required|string',
                    'old'=>'required|numeric',
                    'fleet_id'=>'required|numeric',
                    'status'=>'required|numeric'
                ];
            case 'PATCH':
                return [
                    'user_id'=>'required|numeric',
                    'driver_name'=>'required|string',
                    'sex'=>'required|string',
                    'old'=>'required|numeric',
                    'fleet_id'=>'numeric',
                    'status'=>'required|numeric'
                ];                        
            case 'GET':
            case 'DELETE':
                return[

                ];                
        }
    }

}
