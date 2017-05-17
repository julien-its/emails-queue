# Julien-ITS 

## emails-queue

### Features

Service you can use to send your emails to a queue system. All your emails will be stored in your database to keep logs of them. 
Send your emails directly or with a cron using the queue. 
Define how many emails you want to send each time you call the process queue action.

### Installation

Email-queue requires twig/twig and doctrine/doctrine-bundle

Install with composer

```sh
$ composer.phar require julien-its/emails-queue
```

### Instructions

Once installed, you have to register the EmailsQueueBundle in your AppKernel.php file :

```sh
new JulienIts\Bundle\EmailsQueueBundle\EmailsQueueBundle()
```

Modify your config.yml file and add this import line

```sh
- { resource: "@EmailsQueueBundle/Resources/config/services.yml" }
```

Generate new tables in your database

```sh
$ php bin/console doctrine:schema:update --force
```

Create a new service 

```sh
<?php
namespace AppBundle\Services;
use \JulienIts\Bundle\EmailsQueueBundle\Entity\EmailQueue;
class EmailService
{
	const DEFAULT_SUBJECT = "My App";
    protected $jitsEmailService;
    
    public function __construct(\JulienIts\Bundle\EmailsQueueBundle\Services\EmailService $jitsEmailService)
    {
        $this->jitsEmailService = $jitsEmailService;
    }
	
	public function contact($message)
	{
        $config = array(
            'template' => 'AppBundle:mail:contact.html.twig',
            'templateVars' => array('message' => $message),
            'contextName' => 'contact',
            'priority' => EmailQueue::HIGH_PRIORITY,
            'subject' => self::DEFAULT_SUBJECT.' : Contact',
            'emailTo' => 'toemail@to.com',
            'setEmailsCc' => array('contact@julien-gustin.be')
        );
		$this->jitsEmailService->createNewAndProcess($config);
	}
}
```

Register your service in services.yml :

```sh
services:
    services.email:
        class: AppBundle\Services\EmailService
        arguments:
            jitsEmailService: "@jits.services.email"
```

To send your email, call your service in a controller :

```sh
$message = array(
    'name' => 'Julien',
    'phone' => '+32484263299',
    'message' => 'Voici mon mail'
);
$this->get('services.email')->contact($message);
```
