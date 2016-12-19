<?php

namespace App\Http\Requests\Band;

use App\Http\Requests\Request;

/**
 * Request for Albums
 *
 * @author Eczek
 */
class AlbumFormRequest extends Request 
{
    public function authorize() 
    {
        return true;
    }
    
    public function rules() 
    {
        return [
            'name' => 'required|max:255',
            'band_id' => 'required|integer|min:0',
            'recorded_date' => 'before_than:release_date',
            'label' => 'max:255',
            'producer' => 'max:255',
            'genre' => 'max:255'
        ];
    }
}
