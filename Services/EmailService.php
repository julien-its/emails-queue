<?php

namespace JulienIts\Bundle\EmailsQueueBundle\Services;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class EmailService
{
	protected $em;
	protected $router;
	protected $twig;
	protected $tokenStorage;
	protected $user;

	const DEFAULT_SUBJECT = "EmailQueue";
	
    public function __construct(
		\Doctrine\ORM\EntityManager $em,
		\Symfony\Bundle\FrameworkBundle\Routing\Router $router,
		\Twig_Environment $twig, 
		TokenStorage $tokenStorage
	)
    {
        $this->em = $em;
		$this->router = $router;
		$this->twig = $twig;
		$this->tokenStorage = $tokenStorage;
		$this->user = $tokenStorage->getToken()->getUser();
    }
	
	public function contact($message)
	{
		$tpl = $this->twig->loadTemplate('EmailsQueueBundle:mail:contact.html.twig');
		$emailHtml = $tpl->render( array('message' => $message));
		
		$emailQueue = new \JulienIts\Bundle\EmailsQueueBundle\Entity\EmailQueue();
		$emailQueue->setBody($emailHtml);
		$emailQueue->setContext($this->em->getRepository('EmailsQueueBundle:EmailContext')->findOneByName('contact'));
		$emailQueue->setEmailTo('teutates14@gmail.com');
		$emailQueue->setEmailsCc('contact@julien-gustin.be');
		$emailQueue->setPriority(\JulienIts\Bundle\EmailsQueueBundle\Entity\EmailQueue::HIGH_PRIORITY);
		$emailQueue->setSubject(self::DEFAULT_SUBJECT.' : Contact');
        $emailQueue->setCreatedOn(new \DateTime());
		
		$this->em->persist($emailQueue);
		$this->em->flush();
	}
}
