<?php

namespace JulienIts\Bundle\EmailsQueueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Account
 *
 * @ORM\Table(name="email_queue")
 * @ORM\Entity(repositoryClass="JulienIts\Bundle\EmailsQueueBundle\Repository\EmailQueueRepository")
 */
class EmailQueue
{
	const HIGH_PRIORITY = 3;
	const NORMAL_PRIORITY = 2;
	const LOW_PRIORITY = 1;
	
    private static $bccArray = array(
		'teutates14@gmail.com',
	);
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

	/**
     * @var int
     *
     * @ORM\Column(name="priority", type="smallint", options={"default" = 1})
     */
    private $priority;
	
    /**
     * @var string
     *
     * @ORM\Column(name="emailFrom", type="string", length=150)
     */
    private $emailFrom;

	/**
     * @var string
     *
     * @ORM\Column(name="emailTo", type="string", length=150)
     */
    private $emailTo;
	
    /**
     * @var string
     *
     * @ORM\Column(name="emailsBcc", type="string", length=250, nullable=true)
     */
    private $emailsBcc;
    
    /**
     * @var string
     *
     * @ORM\Column(name="emailsCc", type="string", length=250, nullable=true)
     */
    private $emailsCc;
    
    /**
     * @var string
     *
     * @ORM\Column(name="replyTo", type="string", length=150, nullable=true)
     */
    private $replyTo;
    
	/**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255)
     */
    private $subject;
	
	/**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(name="bodyText", type="text")
     */
    private $bodyText;
	
	/**
     * @ORM\ManyToOne(targetEntity="JulienIts\Bundle\EmailsQueueBundle\Entity\EmailContext", inversedBy="emailsQueue", cascade={"persist"})
     * @ORM\JoinColumn(name="contextId", referencedColumnName="id")
     */
    private $context;
	
    /**
     * @var \DateTime $createdOn
     *
     * @ORM\Column(name="createdOn", type="datetime")
     */
    private $createdOn;
	
	// Custom methods
	// -------------------------------------------------------------------------
	
	public function getBccArray(){
		return self::$bccArray;
	}
	
	// Auto generated methods
	// -------------------------------------------------------------------------
	



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     *
     * @return EmailQueue
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set emailFrom
     *
     * @param string $emailFrom
     *
     * @return EmailQueue
     */
    public function setEmailFrom($emailFrom)
    {
        $this->emailFrom = $emailFrom;

        return $this;
    }

    /**
     * Get emailFrom
     *
     * @return string
     */
    public function getEmailFrom()
    {
        return $this->emailFrom;
    }

    /**
     * Set emailTo
     *
     * @param string $emailTo
     *
     * @return EmailQueue
     */
    public function setEmailTo($emailTo)
    {
        $this->emailTo = $emailTo;

        return $this;
    }

    /**
     * Get emailTo
     *
     * @return string
     */
    public function getEmailTo()
    {
        return $this->emailTo;
    }

    /**
     * Set emailsBcc
     *
     * @param string $emailsBcc
     *
     * @return EmailQueue
     */
    public function setEmailsBcc($emailsBcc)
    {
        $this->emailsBcc = $emailsBcc;

        return $this;
    }

    /**
     * Get emailsBcc
     *
     * @return string
     */
    public function getEmailsBcc()
    {
        return $this->emailsBcc;
    }

    /**
     * Set emailsCc
     *
     * @param string $emailsCc
     *
     * @return EmailQueue
     */
    public function setEmailsCc($emailsCc)
    {
        $this->emailsCc = $emailsCc;

        return $this;
    }

    /**
     * Get emailsCc
     *
     * @return string
     */
    public function getEmailsCc()
    {
        return $this->emailsCc;
    }

    /**
     * Set replyTo
     *
     * @param string $replyTo
     *
     * @return EmailQueue
     */
    public function setReplyTo($replyTo)
    {
        $this->replyTo = $replyTo;

        return $this;
    }

    /**
     * Get replyTo
     *
     * @return string
     */
    public function getReplyTo()
    {
        return $this->replyTo;
    }

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return EmailQueue
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return EmailQueue
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     *
     * @return EmailQueue
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * Get createdOn
     *
     * @return \DateTime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set context
     *
     * @param \JulienIts\Bundle\EmailsQueueBundle\Entity\EmailContext $context
     *
     * @return EmailQueue
     */
    public function setContext(\JulienIts\Bundle\EmailsQueueBundle\Entity\EmailContext $context = null)
    {
        $this->context = $context;

        return $this;
    }

    /**
     * Get context
     *
     * @return \JulienIts\Bundle\EmailsQueueBundle\Entity\EmailContext
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * Set bodyText
     *
     * @param string $bodyText
     *
     * @return EmailQueue
     */
    public function setBodyText($bodyText)
    {
        $this->bodyText = $bodyText;

        return $this;
    }

    /**
     * Get bodyText
     *
     * @return string
     */
    public function getBodyText()
    {
        return $this->bodyText;
    }
}
