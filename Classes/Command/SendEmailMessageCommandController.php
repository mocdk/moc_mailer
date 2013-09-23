<?php
namespace MOC\MocMailer\Command;

use MOC\MocMailer\Message\SendSimpleMailMessage;
use MOC\MocMailer\Message\SendSwiftMailMessage;
use TYPO3\CMS\Extbase\Mvc\Controller\CommandController;

/**
 * Command controller for testing mail shipping using the message queue
 *
 * Provides two different methods for sending mails. Swift and simple.
 *
 * @package MOC\MocMailer
 */
class SendEmailMessageCommandController extends CommandController {

	/**
	 * @var \MOC\MocMessageQueue\Queue\QueueInterface
	 * @inject
	 */
	protected $queue;

	/**
	 * Publish a message to send an email to someone using php simple mail command
	 *
	 * @param string $subject
	 * @param string $message
	 * @param string $recipient
	 * @param string $sender
	 * @return void
	 */
	public function sendSimpleEmailMessageCommand($subject, $message, $recipient, $sender) {
		$message = new SendSimpleMailMessage($subject, $message, $recipient, $sender);
		$this->queue->publish($message);
	}

	/**
	 * Publish a message to send an e-mail using the builtin swift mailer
	 *
	 * @param string $subject
	 * @param string $message
	 * @param string $recipient
	 * @param string $sender
	 * @return void
	 */
	public function sendSwiftEmailMessageCommand($subject, $message, $recipient, $sender) {
		$mailMessage = $this->objectManager->get('TYPO3\CMS\Core\Mail\MailMessage');
		$mailMessage->setFrom(array($sender))
			->setSubject($subject)
			->setBody($message, 'text/plain')
			->setTo(array($recipient));

		$queueMessage = new SendSwiftMailMessage($mailMessage);
		$this->queue->publish($queueMessage);
	}

}