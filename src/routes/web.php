<?php

Route::group(['namespace' => 'Sololux\Mailchimp\Http\Controllers', 'middleware' => 'auth'], function(){

	Route::get('manage-mailchimp', 'SoloLuxMailchimpController@mail');

	Route::post('subscribe','SoloLuxMailchimpController@subscribe');

	Route::post('sendCompaign','SoloLuxMailchimpController@sendCompaign');

	Route::get('make-active-subscribers', 'SoloLuxMailchimpController@makeActiveSubscriber');	

});
