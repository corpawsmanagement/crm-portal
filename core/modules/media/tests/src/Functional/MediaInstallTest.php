<?php

declare(strict_types=1);

namespace Drupal\Tests\media\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Tests media Install / Uninstall logic.
 *
 * @group media
 */
class MediaInstallTest extends BrowserTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['media'];

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'stark';

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();
    $this->drupalLogin($this->drupalCreateUser(['administer modules']));
  }

  /**
   * Tests reinstalling after being uninstalled.
   */
  public function testReinstallAfterUninstall(): void {
    $page = $this->getSession()->getPage();
    $assert_session = $this->assertSession();

    // Uninstall the media module.
    $this->container->get('module_installer')->uninstall(['media'], FALSE);

    $this->drupalGet('/admin/modules');
    $page->checkField('modules[media][enable]');
    $page->pressButton('Install');
    $assert_session->pageTextNotContains('could not be moved/copied because a file by that name already exists in the destination directory');
    $assert_session->pageTextContains('Module Media has been installed');
  }

}
