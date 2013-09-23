<?php
namespace MOC\MocMailer\Message;

use MOC\MocMessageQueue\Message\AbstractMessage;
use MOC\MocMessageQueue\Message\MessageInterface;

/**
 * Message for sending a simple e-mail message. The mail can only caing a recipient, a sender a message and a subject.
 *
 * If you require additional headers, more recipients, attached files etc, use the SendSwiftMailerMessage instead.
 *
 * @package MOC\MocMailer
 */
class SendSimpleMailMessage extends AbstractMessage implements MessageInterface {

	/**
	 * @var string
	 */
	public $recipient = '';

	/**
	 * @var string
	 */
	public $sender = '';

	/**
	 * @var string
	 */
	public $message = '';

	/**
	 * @var string
	 */
	public $subject = '';

	/**
	 * @param string $subject
	 * @param string $message
	 * @param string $recipient
	 * @param string $sender
	 */
	public function __construct($subject, $message, $recipient, $sender) {
		$this->message = $message;
		$this->recipient = $recipient;
		$this->sender = $sender;
		$this->subject = $subject;
	}

}