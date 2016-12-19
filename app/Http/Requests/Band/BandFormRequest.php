<?php

namespace App\Http\Requests\Band;

use App\Http\Requests\Request;

/**
 * Request for Band
 *
 * @author Eczek
 */
class BandFormRequest extends Request 
{
    public function authorize() 
    {
        return true;
    }
    
    public function rules() 
    {
        return [
            'name' => 'required|max:255',
            'website' => 'max:2083'
        ];
    }
}
