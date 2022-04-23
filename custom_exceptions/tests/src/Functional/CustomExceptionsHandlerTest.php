<?php

namespace Drupal\Tests\custom_exceptions\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Tests Error Messaging.
 *
 * @group custom_exceptions
 */
class CustomExceptionsHandlerTest extends BrowserTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'custom_exceptions',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    // Make sure to complete the normal setup steps first.
    parent::setUp();
    // Set the front page to "node".
    \Drupal::configFactory()
      ->getEditable('system.site')
      ->set('page.front', '/node')
      ->save(TRUE);
  }
  
  /**
   * Tests the Messages.
   */
  public function testMessages() {
    $assert_session = $this->assertSession();

    $this->drupalGet('missing');
    $assert_session->pageTextContains('THE PAGE IS MISSING!');

    $this->drupalGet('admin');
    $assert_session->pageTextContains('DO NOT ENTER!');
  }

}
