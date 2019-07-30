<?php

namespace Sololux\Mailchimp\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Config;
use App\Customer;

class SoloLuxMailchimpController extends Controller
{
	public $mailchimp;
    public $listId = '5c65d1c4bd';

    public function __construct(\Mailchimp $mailchimp)
    {
        $this->mailchimp = $mailchimp;
        $this->listId = getenv('LIST_ID');
    }

	public function mail(){
		return view('mailchimp::mail-chimp');
	}

    public function subscribe(Request $request){
    	
    	$this->validate($request, [
	    	'email' => 'required|email',
        ]);

        try {

            $this->mailchimp
            ->lists
            ->subscribe(
                $this->listId,
                ['email' => $request->input('email')]
            );

            return redirect()->back()->with('success','Email Subscribed successfully');

        } catch (\Mailchimp_List_AlreadySubscribed $e) {
            return redirect()->back()->with('error','Email is Already Subscribed');
        } catch (\Mailchimp_Error $e) {
            return redirect()->back()->with('error','Error from MailChimp');
        }
    }
}
