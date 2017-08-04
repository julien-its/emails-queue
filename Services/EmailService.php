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
    protected $emailsQueueService;

    public function __construct(
		\Doctrine\ORM\EntityManager $em,
		\Symfony\Bundle\FrameworkBundle\Routing\Router $router,
		\Twig_Environment $twig,
		TokenStorage $tokenStorage,
        $emailsQueueService
	)
    {
        $this->em = $em;
		$this->router = $router;
		$this->twig = $twig;
		$this->tokenStorage = $tokenStorage;
		$this->user = $tokenStorage->getToken()->getUser();
        $this->emailsQueueService = $emailsQueueService;
    }

    public function createNewAndProcess($config)
    {
        $this->createNew($config);
        $this->emailsQueueService->processQueue(1);
    }

	public function createNew($config)
	{
		$tpl = $this->twig->loadTemplate($config['template']);
		$emailHtml = $tpl->render($config['templateVars']);

		$emailQueue = new \JulienIts\Bundle\EmailsQueueBundle\Entity\EmailQueue();
		$emailQueue->setBody($emailHtml);
		$emailQueue->setContext($this->em->getRepository('EmailsQueueBundle:EmailContext')->findOneByName('contact'));
		$emailQueue->setEmailTo($config['emailTo']);
        if(isset($config['emailsCc'])){
            $emailQueue->setEmailsCc($config['emailsCc']);
        }
        if(isset($config['emailsBcc'])){
            $emailQueue->setEmailsBcc($config['emailsBcc']);
        }

		$emailQueue->setPriority($config['priority']);
		$emailQueue->setSubject($config['subject']);
        $emailQueue->setCreatedOn(new \DateTime());

		$this->em->persist($emailQueue);
		$this->em->flush();
	}
}
