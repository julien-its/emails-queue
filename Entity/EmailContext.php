<?php

namespace JulienIts\Bundle\EmailsQueueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Account
 *
 * @ORM\Table(name="email_context")
 * @ORM\Entity(repositoryClass="EmailBundle\Repository\EmailContextRepository")
 */
class EmailContext
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

	/**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=30)
     */
    private $name;
	
	/**
     * @ORM\OneToMany(targetEntity="JulienIts\Bundle\EmailsQueueBundle\EmailQueue", mappedBy="context")
     */
    private $emailsQueue;
	
	/**
     * @ORM\OneToMany(targetEntity="JulienIts\Bundle\EmailsQueueBundle\EmailSent", mappedBy="context")
     */
    private $emailsSent;
	
	// Custom methods
	// -------------------------------------------------------------------------
	
	/**
     * Constructor
     */
    public function __construct()
    {
        $this->emailsQueue = new \Doctrine\Common\Collections\ArrayCollection();
		$this->emailsSent = new \Doctrine\Common\Collections\ArrayCollection();
    }
	
	// Auto generated methods
	// -------------------------------------------------------------------------
	
    

}
