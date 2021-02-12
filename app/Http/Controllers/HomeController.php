<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsersPhoneNumber;

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

class HomeController extends Controller
{
    
    /**
    * Displays all phone numbers on the HTML drop-down
    *
    * @return Response
    */
    public function show()
    {
        // Query DB and grab all phone numbers for all users on the table
        $users = UsersPhoneNumber::all(); 
        
        //dd($users);
        // Return to the Welcome page
        return view('welcome', compact("users"));
        // compact() is a PHP function that allows you to create 
        // an array with variable names and their values.
    }
    
    /**
    * Store a new user phone number.
    *
    * @param  Request  $request
    * @return Response
    */
    public function storePhoneNumber(Request $request)
    {
        // Validates the phone number that was provided
        $validatedData = $request->validate([
            'phone_number' => 'required|unique:users_phone_number|numeric'
        ]);

        // Create new phone number on the DB
        $user_phone_number_model = new UsersPhoneNumber($request->all());
        
        // Store the phone number onto the DB
        $user_phone_number_model->save();
        
        // Whenever a user’s phone number is added to DB, we can send the user a notification message
        $this->sendMessage('User registration successful!!', $request->phone_number);

        // Return with a "success" message
        return back()->with(['success'=>"{$request->phone_number} registered"]);
    }

    /**
    * Send message to selected users
    */
    public function sendCustomMessage(Request $request)
    {
        // Grab all the phones numbers you want to send the message to
        $validatedData = $request->validate([
            'users' => 'required|array',
            'body' => 'required',
        ]);
        
        // Create a variable with only the phone numbers
        $recipients = $validatedData["users"];
        
        // Iterate over the array of recipients and send a twilio request for each
        foreach ($recipients as $recipient) {
            $this->sendMessage($validatedData["body"], $recipient);
        }
        return back()->with(['success' => "Messages on their way!"]);
    }

    /**
    * Sends sms to user using Twilio's programmable sms client
    * @param String $message Body of sms
    * @param Number $recipients string or array of phone number of recepient
    */
    private function sendMessage($message, $recipients)
    {

        // Grab Twilio credentials
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        
        // Create a Twilio connection
        $client = new Client($account_sid, $auth_token);
        
        // Send the SMS
        $message = $client->messages->create($recipients, [
                'from' => $twilio_number, 
                'body' => $message
        ]);
    }
}
