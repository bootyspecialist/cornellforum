<?php

class UserController extends Vendor\Sentinel\UserController {

	/**
	 * Store a newly created user and kick them back to the verification sent page.
	 *
	 * @return Response
	 */
	public function store()
	{
        // Collect Data
        $data = Input::all();
        $data['groups'] = Config::get('Sentinel::config.default_user_groups');

        // Form Processing
        $result = $this->registerForm->save( $data );

        if( $result['success'] )
        {
            // Success!
            Session::flash('success', $result['message']);
            return View::make('verificationsent');

        } else {
            Session::flash('error', $result['message']);
            return Redirect::route('Sentinel\register')
                ->withInput()
                ->withErrors( $this->registerForm->errors() );
        }
	}
}
