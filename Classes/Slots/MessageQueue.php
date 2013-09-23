<?php
namespace MOC\MocMailer\Slots;

use MOC\MocMailer\Message\SendSimpleMailMessage;
use MOC\MocMailer\Message\SendSwiftMailMessage;
use MOC\MocMessageQueue\Message\MessageInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class MessageQueue {

	/**
	 * Handle messages related to mail sending.
	 *
	 * Will handle messages of type SendSimpleMailMessage og SendSwiftMailMessage.
	 *
	 * @param MessageInterface $message
	 * @return void
	 */
	public function handleMessage(MessageInterface $message) {

		if ($message instanceof SendSimpleMailMessage) {
			mail($message->recipient, $message->subject, $message->message,array('From' => $message->sender));
			GeneralUtility::devLog(sprintf('Sending email to %s using php mail function.', $message->recipient, 'moc_mailer'));
		}

		if ($message instanceof SendSwiftMailMessage) {
			$recipient = $message->swiftMailerObject->getTo();
			GeneralUtility::devLog(sprintf('Sending email to %s using swiftmailer.', key($recipient), 'moc_mailer'));
			$message->swiftMailerObject->send();
		}
	}

}