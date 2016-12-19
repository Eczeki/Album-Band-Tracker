<?php

namespace App\Models\Band;

use Illuminate\Database\Eloquent\Model;

class Band extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'band';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
    /**
     * Fields allowed for mass assignment
     * 
     * @var array
     */
    protected $fillable = ['id', 'name', 'start_date', 'website', 'still_active'];
    
    /**
     * Gets the albums associated with this band
     */
    public function albums()
    {
        return $this->hasMany('App\Models\Band\Album');
    }
    
    public function __toString() 
    {
        return $this->name;
    }
}