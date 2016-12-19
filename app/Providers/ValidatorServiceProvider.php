<?php 

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider {

    public function boot()
    {        
        $this->app['validator']->extend('before_than', function ($attribute, $value, $parameters, $validator)
        {
            if(!isset($parameters[0])) {
                throw new \Exception('Missing first parameter for before_than validation rule');
            }
            
            $earlierDate = $value;
            $laterDate = array_get($validator->getData(), $parameters[0]);
            
            return $laterDate > $earlierDate;
        });
        
        
    }

    public function register()
    {
        //
    }
}