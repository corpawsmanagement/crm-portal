<?php

declare(strict_types=1);

namespace Drupal\Tests\user\Kernel\Migrate\d7;

use Drupal\Core\Entity\Entity\EntityViewDisplay;
use Drupal\Tests\migrate_drupal\Kernel\d7\MigrateDrupal7TestBase;

/**
 * User picture entity display.
 *
 * @group user
 */
class MigrateUserPictureEntityDisplayTest extends MigrateDrupal7TestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['file', 'image'];

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();
    $this->installEntitySchema('file');
    $this->executeMigrations([
      'user_picture_field',
      'user_picture_field_instance',
      'user_picture_entity_display',
    ]);
  }

  /**
   * Tests the Drupal 7 user picture to Drupal 8 entity display migration.
   */
  public function testUserPictureEntityDisplay(): void {
    $component = EntityViewDisplay::load('user.user.default')->getComponent('user_picture');
    $this->assertSame('image', $component['type']);
    $this->assertSame('', $component['settings']['image_style']);
    $this->assertSame('content', $component['settings']['image_link']);
  }

}
