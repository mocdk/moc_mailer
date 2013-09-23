<?php
namespace MOC\MocMailer\Message;

use MOC\MocMessageQueue\Message\AbstractMessage;
use MOC\MocMessageQueue\Message\MessageInterface;

/**
 * Message for sending an e-mail using the TYPO3 builtin swift mailer.
 *
 *
 * @package MOC\MocMailer\Message
 */
class SendSwiftMailMessage extends AbstractMessage implements MessageInterface {

	/**
	 * @var \TYPO3\CMS\Core\Mail\MailMessage
	 */
	public $swiftMailerObject;

	/**
	 * @param \TYPO3\CMS\Core\Mail\MailMessage $swiftMailerObject
	 */
	public function __construct(\TYPO3\CMS\Core\Mail\MailMessage $swiftMailerObject) {
		$this->swiftMailerObject = $swiftMailerObject;
	}

}