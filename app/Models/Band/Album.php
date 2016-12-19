<?php

namespace App\Models\Band;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'album';
    
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
    protected $fillable = [
        'band_id', 
        'name', 
        'recorded_date', 
        'release_date',
        'number_of_tracks', 
        'label',
        'producer',
        'genre'
    ];
    
    /**
     * Gets the band record that owns this album.
     */
    public function band()
    {
        return $this->belongsTo('App\Models\Band\Band');
    }
    
}