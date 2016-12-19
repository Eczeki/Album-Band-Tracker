<?php 

namespace App\Forms\Band;

use Kris\LaravelFormBuilder\Form;

/**
 * Edit/Create form for Bands
 * 
 * @author Eczek
 */
class BandForm extends Form
{
    public function buildForm()
    {        
        $this
            ->add('name', 'text', [
                'label' => 'Band Name',
                'rules' => 'required',
                'value' => $this->getData('name'),
                'error_messages' => [
                    'name.required' => 'Name is a required field!'
                ]
            ])
            ->add('start_date', 'date', [
                'label' => 'Creation Date',
                'value' => $this->getData('start_date')
            ])
            ->add('website', 'url', [
                'label' => 'Website',
                'value' => $this->getData('website')
            ])
            ->add('still_active', 'checkbox', [
                'label' => 'Still Active?',
                'checked' => $this->getData('still_active')
            ])
            ->add('Save', 'submit', [
                'attr' => [
                    'class' => 'btn btn-default'
                ]
            ]);
        
    }
}