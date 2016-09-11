<?php

    class Mail {
   
    function __construct() 
    {
        $this->smtp = "host.caracashosting50.com";
        $this->port = 465;
        $this->secure = "ssl";
        $this->username = "mdandrad@frbcomputersgroup.com.ve";
        $this->password = "230386";
        
    }
    
    
    
    function send($to = array(), $from = array() , $subject , $message ) 
    {
        $transport = Swift_SmtpTransport::newInstance( $this->smtp, $this->port, $this->secure)
          ->setUsername($this->username)
          ->setPassword($this->password);
        // Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);

        // Create a message
        $send = Swift_Message::newInstance($subject)
          ->setFrom($from)
          ->setTo($to)
          ->setBody($message)
          ;

        // Send the message
        $result = $mailer->send($send);        
    }
    

}

