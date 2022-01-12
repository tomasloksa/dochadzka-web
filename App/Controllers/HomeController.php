<?php

namespace App\Controllers;

use App\Core\AControllerBase;

class HomeController extends AControllerRedirect
{

    public function index()
    {
        return $this->html();
    }

    public function contact()
    {
        return $this->html();
    }

    public function sendEmail() 
    {
        $name = $this->request()->getValue('name');
        $contact = $this->request()->getValue('contact');
        $message = $this->request()->getValue('message');

        $to = "tomiloksa@gmail.com";
        $email_subject = "Nova sprava z dochadzky";
	    $email_body = "Nova sprava od: $name.\n".
                      "Odpovedat na: $contact.\n".
                      ":\n $message";

        $headers = "From: dochadzka-formular";
        
        fb(mail($to,$email_subject,$email_body,$headers));

        $this->redirect('home');
    }

    public function download()
    {
        return $this->html();
    }

    public function news()
    {
        return $this->html();
    }
}