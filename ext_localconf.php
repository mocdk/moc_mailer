<?php

/** @var \TYPO3\CMS\Extbase\SignalSlot\Dispatcher $signalSlotDispatcher */
$signalSlotDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\SignalSlot\\Dispatcher');
$signalSlotDispatcher->connect(
        'MOC\MocMessageQueue\Command\QueueWorkerCommandController',
        'messageReceived',
        'MOC\MocMailer\Slots\MessageQueue',
        'handleMessage'
);

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] = 'Moc\MocMailer\Command\SendEmailMessageCommandController';
