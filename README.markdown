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
$ composer require julien-its/emails-queue
```

### Instructions

Once installed,
**register the EmailsQueueBundle in your AppKernel.php file :**

*app/AppKernel.php*

    new JulienIts\Bundle\EmailsQueueBundle\EmailsQueueBundle()

**Modify your config.yml adding this import line**

*app/Resources/config/config.yml*

     resource: "@EmailsQueueBundle/Resources/config/services.yml"

**Generate new tables in your database with doctrine**

```sh
$ php bin/console doctrine:schema:update --force
```

**Create a new email service** where you will define all your emails methods. We only add one exemple of a contact form email

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
                'template' => 'EmailsQueueBundle:mail:contact.html.twig',
                'templateVars' => array('message' => $message),
                'contextName' => 'contact',
                'priority' => EmailQueue::HIGH_PRIORITY,
                'subject' => self::DEFAULT_SUBJECT.' : Contact',
                'emailTo' => 'toemail@to.com',
                'mailsCc' => 'contact@julien-gustin.be;email2@email.com'
            );
    		$this->jitsEmailService->createNewAndProcess($config);
    	}
    }

Note that you can copy the contact.html and email layout on your own appBundle to personalize them

**Two possibilities when creating an emailQueue :**

    $this->jitsEmailService->createNew($config);
    $this->jitsEmailService->createNewAndProcess($config);

createNewAndProcess Will directly process the email queue and send it to your mail service.

**Register your service in services.yml** :

*app/Resources/config/services.yml*

```sh
services:
    services.email:
        class: AppBundle\Services\EmailService
        arguments:
            $jitsEmailService: "@jits.services.email"
```

### Send an email

To send your email, call your service in a controller :

```sh
$message = array(
    'name' => 'Julien Gustin',
    'phone' => '+320484010203',
    'message' => 'gustin.julien@gmail.com'
);
$this->get('services.email')->contact($message);
```
### Define the cron action

If you went to send emails by packets, register the route in your routing.yml file

*app/Resources/config/routing.yml*

    emailsQueue:
        resource: '@EmailsQueueBundle/Controller/'
        type: annotation

URL will be like : /emails-queue/cron/process-mail-queue
