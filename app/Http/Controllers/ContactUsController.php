<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\ContactUs;

class ContactUsController extends Controller
{
    public function contactUs()
    {
      return view('contactUs');
    }
    public function contactUsPost(Request $request)
    {
      $this->validate($request, [
        'name'=> 'required',
        'email'=>'required|email',
        'message'=>'required'
      ]);
      ContactUs::create($request->all());

      Mail::send('email',
      array(
        'name'=> $request->get('name'),
        'email' => $request->get('email'),
        'user_message'=>$request->get('message')
      ), function($message)
   {
       $message->from('example@gmail.com');
       $message->to('joshshelton309@gmail.com', 'Admin')->subject('Cloudways Feedback');
   });
      return back()->with('Success', 'Thanks for contacting us!');
    }
}
