<?php

namespace App\Http\Controllers;
use View;
use Illuminate\Support\Facades\Validator as Validator;
use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Redirect;
use App\Providers\SigWSService;

class HomeController extends BaseController
{

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/', 'HomeController@showWelcome');
    |
    */

    public function showWelcome()
    {
        return View::make('hello');
    }

    public function showLogin()
    {
        // show the form
        return View::make('login');
    }

    public function doLogin()
    {
        // validate the info, create rules for the inputs
        $rules = array(
            'login' => 'required', // make sure the login is an actual login
            'senha' => 'required' // required|alphaNum|min:3 senha can only be alphanumeric and has to be greater than 3 characters
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('login')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput(Input::except('senha')); // send back the input (not the senha) so that we can repopulate the form
        } else {

            // create our user data for the authentication
            $userdata = array(
                'login' => Input::get('login'),
                'senha' => Input::get('senha')
            );


            $loginSigWS = SigWSService::login($userdata);

            // attempt to do the login
            if (!empty($loginSigWS)) {

                var_dump(var_export($loginSigWS,true));

                // validation successful!
                // redirect them to the secure section or whatever
                // return Redirect::to('secure');
                // for now we'll just echo success (even though echoing in a controller is bad)

                echo 'SUCCESS!';

            } else {

                // validation not successful, send back to form
                return Redirect::to('login');

            }

        }
    }

}