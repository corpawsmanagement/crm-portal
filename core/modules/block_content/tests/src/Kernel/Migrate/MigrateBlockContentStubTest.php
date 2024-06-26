<?php

declare(strict_types=1);

namespace Drupal\Tests\block_content\Kernel\Migrate;

use Drupal\block_content\Entity\BlockContentType;
use Drupal\migrate\MigrateException;
use Drupal\Tests\migrate_drupal\Kernel\MigrateDrupalTestBase;
use Drupal\migrate_drupal\Tests\StubTestTrait;

/**
 * Test stub creation for block_content entities.
 *
 * @group block_content
 */
class MigrateBlockContentStubTest extends MigrateDrupalTestBase {

  use StubTestTrait;

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['block_content'];

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();
    $this->installEntitySchema('block_content');
  }

  /**
   * Tests creation of block content stubs with no block_content_type available.
   */
  public function testStubFailure(): void {
    // Expected MigrateException thrown when no bundles exist.
    $this->expectException(MigrateException::class);
    $this->expectExceptionMessage('Stubbing failed, no bundles available for entity type: block_content');
    $this->createEntityStub('block_content');
  }

  /**
   * Tests creation of block content stubs when there is a block_content_type.
   */
  public function testStubSuccess(): void {
    BlockContentType::create([
      'id' => 'test_block_content_type',
      'label' => 'Test block content type',
    ])->save();
    $this->performStubTest('block_content');
  }

}
