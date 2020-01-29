<?php

namespace App\Service;

use Symfony\Component\Templating\EngineInterface;



class Mailer
{
    protected $maile;
    protected $templating;
    protected $from = 'orange@orange.sn';
    protected $name = 'torch';
    public function __construct(\Swift_Mailer $maile,EngineInterface $templating){
        $this->maile = $maile;
        $this->templating = $templating;
    }
    public function Notif($to, $subject, $body)
        {
            $mail = new \Swift_Message(utf8_encode($subject));

            $mail->setFrom(array($this->from => $this->name))
                ->setTo($to)
        //setSubject(utf8_encode($subject))
                ->setBody(
                    $this->templating->render(
                            'Mail/notif.html.twig',
                            array('body' => $body)))
                ->setContentType('text/html')
                ->setCharset('utf-8');
            return $this->maile->send($mail);
        }
}
