<?php

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class mailing {

	public function __construct() {
		global $db, $functions;
		$this->functions = $functions;
		$loader = new FilesystemLoader(_VIEWS_);
		$this->twig = new Environment($loader, array(
			'cache' => false,
		));;

	}

	public function contactenos($args){
		try{
			$data = $this->twig->render('mailing/contactenos.twig', ['args' => $args]);
			return $data;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function servicios($args){
		try{
			$data = $this->twig->render('mailing/servicios.twig', ['args' => $args]);
			return $data;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}


	function SwiftSend($correo, $nombre, $pTitle, $pTo, $pBody, $pAttach=array(), $_AccountFrom='', $_NameAccountFrom=''){
		$transport = Swift_MailTransport::newInstance();
		$mailer = Swift_Mailer::newInstance($transport);
		$message = Swift_Message::newInstance($pTitle)
		->setFrom(array($correo => $nombre))
		->setTo($pTo)
		->setBody($pBody);
		$message->setContentType("text/html");

		foreach($pAttach as $pVal):
			$message->attach(Swift_Attachment::fromPath($pVal));
		endforeach;
		return $numSent = $mailer->send($message);
	}


	function SwiftSend_STMP($pTitle, $pTo, $pName, $pBody, $pAttach=array(), $_AccountFrom='', $_NameAccountFrom=''){
		$nombre = EMAILNAME;
		$correo = EMAIL;
		$transport = Swift_SmtpTransport::newInstance('mail.estudioshaddai.com', 465, 'ssl')
		->setUsername($correo)
		->setPassword(EMAILPASS);


		$mailer = Swift_Mailer::newInstance($transport);
		$message = Swift_Message::newInstance($pTitle)
		->setFrom(array($correo => $nombre))
		->setTo([$pTo => $pName])
		->setBody($pBody);
		$message->setContentType("text/html");

		foreach($pAttach as $pVal):
			$message->attach(Swift_Attachment::fromPath($pVal));
		endforeach;
		return $numSent = $mailer->send($message);
	}

	function SwiftSend_STMP_SEND($nombre, $pTitle, $pTo, $pBody, $scorreo = null,  $pAttach=array(), $_AccountFrom='', $_NameAccountFrom=''){
		$correo = EMAIL;
		$transport = Swift_SmtpTransport::newInstance('mail.estudioshaddai.com', 465, 'ssl')
		->setUsername($correo)
		->setPassword(EMAILPASS);


		$mailer = Swift_Mailer::newInstance($transport);
		$message = Swift_Message::newInstance($pTitle)
		->setFrom(array($correo => $nombre))
		->setTo($pTo)
		->setReplyTo($scorreo)
		->setBody($pBody);
		$message->setContentType("text/html");

		foreach($pAttach as $pVal):
			$message->attach(Swift_Attachment::fromPath($pVal));
		endforeach;
		return $numSent = $mailer->send($message);
	}

}

$mailing = new mailing();