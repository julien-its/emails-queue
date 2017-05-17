<?php
namespace JulienIts\Bundle\EmailsQueueBundle\Services;

use JulienIts\Bundle\EmailsQueueBundle\Entity\EmailQueue;
use JulienIts\Bundle\EmailsQueueBundle\Entity\EmailSent;

class EmailsQueueService
{
    //const WHITE_LIST_ENABLE = false;
	protected $em;
	protected $mailer;
	protected $appMode;
    
    public function __construct(\Doctrine\ORM\EntityManager $em, $mailer)
    {
        $this->em = $em;
        $this->mailer = $mailer;
    }
	
    
    public function processQueue($limit=15)
    {
        $queueRepo = $this->em->getRepository('EmailsQueueBundle:EmailQueue');
        $emailsQueue = $queueRepo->findBy(array(), array('priority'=>'desc', 'id'=>'desc'), $limit);
        foreach($emailsQueue as $emailQueue){
            //echo "Send emailQ:".$emailQueue->getId(), "<br/>";
            $this->_sendEmailQueue($emailQueue);
            $this->_setEmailQueueToSent($emailQueue);
        }
    }
    
    private function _sendEmailQueue(EmailQueue $emailQueue)
    {
		$message = \Swift_Message::newInstance();
		 
        $to = $emailQueue->getEmailTo();
        
        if($emailQueue->getReplyTo() != null && $emailQueue->getReplyTo() != ''){
            $message->addReplyTo($emailQueue->getReplyTo());
        }
        
        $message->setSubject($emailQueue->getSubject())
				->setFrom('info@custom-booking.be')
				->setTo($to)
				->setBody($emailQueue->getBody(),'text/html');
        
        foreach($emailQueue->getBccArray() as $bcc){
            if($bcc == $to)
                continue;
            $message->addBcc($bcc);
        }
        
        // Add CC from the emailQueue entity
        if($emailQueue->getEmailsCc() != null){
            $arrEmails = explode(';', $emailQueue->getEmailsCc());
            foreach($arrEmails as $email){
                $email = trim($email);
                if($email == $to){
                    continue;
                }
                if(in_array($email, $emailQueue->getBccArray())){
                    continue;
                }
                $message->addCc($email);
            }
        }
        
        // Add BCC from the emailQueue entity
        if($emailQueue->getEmailsBcc() != null){
            $arrEmails = explode(';', $emailQueue->getEmailsBcc());
            foreach($arrEmails as $email){
                $email = trim($email);
                if($email == $to){
                    continue;
                }
                if(in_array($email, $emailQueue->getBccArray())){
                    continue;
                }
                $message->addBcc($email);
            }
        }
        
        $this->mailer->send($message);
    }
    
    private function _setEmailQueueToSent(EmailQueue $emailQueue)
    {
        $emailSent = new EmailSent();
        
        $emailSent->setPriority($emailQueue->getPriority());
        $emailSent->setEmailTo($emailQueue->getEmailTo());
        $emailSent->setSubject($emailQueue->getSubject());
        $emailSent->setBody($emailQueue->getBody());
        $emailSent->setCreatedOn($emailQueue->getCreatedOn());
        $emailSent->setContext($emailQueue->getContext());
		$emailSent->setEmailsBcc($emailQueue->getEmailsBcc());
		$emailSent->setEmailsCc($emailQueue->getEmailsCc());
		$emailSent->setReplyTo($emailQueue->getReplyTo());
        
        $this->em->persist($emailSent);
        $this->em->remove($emailQueue);
		$this->em->flush();
    }
}
