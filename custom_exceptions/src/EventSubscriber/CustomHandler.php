<?php

namespace Drupal\custom_exceptions\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class EntityTypeSubscriber.
 *
 * @package Drupal\custom_exceptions\EventSubscriber
 */
class CustomHandler implements EventSubscriberInterface {
  
  /**
   * Rebuilds the router when node.settings:use_admin_theme is changed
   *
   * @param \Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent $event
   *   Exception event.
   */
  public function onException(GetResponseForExceptionEvent $event) {
		// Get the current exception.
		$exception = $event->getException();
		// Enter any required exceptions in the following array.
		$error_array = [
			404 => 'THE PAGE IS MISSING!',
			403 => 'DO NOT ENTER!'
		];
		foreach ($error_array as $key => $val) {
			// Condition to print appropriate message.
			if ($exception->getStatusCode() == $key) {
				\Drupal::messenger()->addWarning($val);
			}
		}
	}
  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[KernelEvents::EXCEPTION][] = ['onException'];
    return $events;
  }
}
