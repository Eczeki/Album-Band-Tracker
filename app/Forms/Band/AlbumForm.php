<?php

namespace App\Forms\Band;

use Kris\LaravelFormBuilder\Form;
use App\Models\Band\Band;

/**
 * Edit/Create Form for Albums
 *
 * @author Eczek
 */
class AlbumForm extends Form 
{
    public function buildForm()
    {        
        $this
            ->add('name', 'text', [
                'label' => 'Album Name',
                'rules' => 'required',
                'value' => $this->getData('name'),
                'error_messages' => [
                    'name.required' => 'Name is a required field!'
                ]
            ])
            ->add('band_id', 'select', [
                'label' => 'Band',
                'rules' => 'required',
                'choices' => Band::lists('name', 'id')->toArray(),
                'selected' => $this->getData('band_id'),
                'error_messages' => [
                    'band_id.required' => 'Band is a required field!'
                ],
                'empty_value' => 'Select a Band'
            ])
            ->add('recorded_date', 'date', [
                'label' => 'Recorded Date',
                'value' => $this->getData('recorded_date')
            ])
            ->add('release_date', 'date', [
                'label' => 'Release Date',
                'value' => $this->getData('release_date')
            ])
            ->add('number_of_tracks', 'number', [
                'label' => 'Number of Tracks',
                'value' => $this->getData('number_of_tracks'),
                'attr' => [
                    'min' => 1
                ]
            ])
            ->add('label', 'text', [
                'label' => 'Label',
                'value' => $this->getData('label')
            ])
            ->add('producer', 'text', [
                'label' => 'Producer',
                'value' => $this->getData('producer')
            ])
            ->add('genre', 'text', [
                'label' => 'Genre',
                'value' => $this->getData('genre')
            ])
            ->add('Save', 'submit', [
                'attr' => [
                    'class' => 'btn btn-default'
                ]
            ]);
        
    }
}
