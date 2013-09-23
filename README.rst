MOC Asynchronous mailer
=======================

This TYPO3 extensions provides messages and corresponding slots for processing mails in an asynchronous fashion.
It provides your code with the ability to schedule mails, but defer the actual sending to another process by simple
publishing a message using the moc_message_queue

Make sure you have the moc_message_queue installed and that the worker is running before trying the examples below.

Examples
--------

In you code, instead of sending a simple mail (using phps mail), publish a message in the message queue that will ship
you email.

.. code-block:: php

	$queue = $this->objectManager->get('MOC\MocMessageQueue\Queue\QueueInterface');
	$message = new SendSimpleMailMessage($subject, $message, $recipient, $sender);
	$queue->publish($message);

Of you you require a little more control of you email, use the TYPO3 Mailer instead

.. code-block:: php

	$queue = $this->objectManager->get('MOC\MocMessageQueue\Queue\QueueInterface');
	$mailMessage = $this->objectManager->get('TYPO3\CMS\Core\Mail\MailMessage');
	$mailMessage->setFrom(array($sender))
		->setSubject($subject)
		->setBody($message, 'text/plain')
		->setTo(array($recipient));

	$queueMessage = new SendSwiftMailMessage($mailMessage);
	$queue->publish($queueMessage);

Now watch the queue work, and the dev log (if configured).

Testing
-------

To test the extension, a simple extbase command for seing simple mails and swiftmailer based mails are provieded.

Use like this

::

	./cli_dispatch.phpsh extbase sendemailmessage:sendsimpleemailmessage 'Test' 'Mesage' 'janerik@moc.net' 'test@moc.net'
	./cli_dispatch.phpsh extbase sendemailmessage:sendswiftemailmessage 'Test' 'Mesage' 'janerik@moc.net' 'test@moc.net'
