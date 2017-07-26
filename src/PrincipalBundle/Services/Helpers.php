<?php

namespace PrincipalBundle\Services;
 
class Helpers 
{
 
    public function sendmail($mail)
    {

		$message = \Swift_Message::newInstance()
		    ->setSubject('Some Subject')
		    ->setFrom('example@gmail.com')
		    ->setTo($mail)
		    ->setBody('hola', 'text/html');

		# Send the message
		$this->get('mailer')
		    ->send($message);
    }

}

?>