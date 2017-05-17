<?php

namespace JulienIts\Bundle\EmailsQueueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Account
 *
 * @ORM\Table(name="email_context")
 * @ORM\Entity(repositoryClass="JulienIts\Bundle\EmailsQueueBundle\Repository\EmailContextRepository")
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
     * @ORM\OneToMany(targetEntity="JulienIts\Bundle\EmailsQueueBundle\Entity\EmailQueue", mappedBy="context")
     */
    private $emailsQueue;
	
	/**
     * @ORM\OneToMany(targetEntity="JulienIts\Bundle\EmailsQueueBundle\Entity\EmailSent", mappedBy="context")
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
     * Set name
     *
     * @param string $name
     *
     * @return EmailContext
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add emailsQueue
     *
     * @param \JulienIts\Bundle\EmailsQueueBundle\Entity\EmailQueue $emailsQueue
     *
     * @return EmailContext
     */
    public function addEmailsQueue(\JulienIts\Bundle\EmailsQueueBundle\Entity\EmailQueue $emailsQueue)
    {
        $this->emailsQueue[] = $emailsQueue;

        return $this;
    }

    /**
     * Remove emailsQueue
     *
     * @param \JulienIts\Bundle\EmailsQueueBundle\Entity\EmailQueue $emailsQueue
     */
    public function removeEmailsQueue(\JulienIts\Bundle\EmailsQueueBundle\Entity\EmailQueue $emailsQueue)
    {
        $this->emailsQueue->removeElement($emailsQueue);
    }

    /**
     * Get emailsQueue
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmailsQueue()
    {
        return $this->emailsQueue;
    }

    /**
     * Add emailsSent
     *
     * @param \JulienIts\Bundle\EmailsQueueBundle\Entity\EmailSent $emailsSent
     *
     * @return EmailContext
     */
    public function addEmailsSent(\JulienIts\Bundle\EmailsQueueBundle\Entity\EmailSent $emailsSent)
    {
        $this->emailsSent[] = $emailsSent;

        return $this;
    }

    /**
     * Remove emailsSent
     *
     * @param \JulienIts\Bundle\EmailsQueueBundle\Entity\EmailSent $emailsSent
     */
    public function removeEmailsSent(\JulienIts\Bundle\EmailsQueueBundle\Entity\EmailSent $emailsSent)
    {
        $this->emailsSent->removeElement($emailsSent);
    }

    /**
     * Get emailsSent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmailsSent()
    {
        return $this->emailsSent;
    }
}
