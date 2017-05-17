<?php

namespace JulienIts\Bundle\EmailsQueueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Account
 *
 * @ORM\Table(name="email_queue")
 * @ORM\Entity(repositoryClass="EmailBundle\Repository\EmailQueueRepository")
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
     * @ORM\ManyToOne(targetEntity="JulienIts\Bundle\EmailsQueueBundle\EmailContext", inversedBy="emailsQueue", cascade={"persist"})
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
	
	

}
