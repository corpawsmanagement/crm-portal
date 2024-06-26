<?php

declare(strict_types=1);

namespace Drupal\Tests\migrate\Unit\Event;

use Drupal\migrate\Event\MigratePreRowSaveEvent;

/**
 * @coversDefaultClass \Drupal\migrate\Event\MigratePreRowSaveEvent
 * @group migrate
 */
class MigratePreRowSaveEventTest extends EventBaseTest {

  /**
   * Tests getRow method.
   *
   * @covers ::__construct
   * @covers ::getRow
   */
  public function testGetRow(): void {
    $migration = $this->prophesize('\Drupal\migrate\Plugin\MigrationInterface')->reveal();
    $message_service = $this->prophesize('\Drupal\migrate\MigrateMessageInterface')->reveal();
    $row = $this->prophesize('\Drupal\migrate\Row')->reveal();
    $event = new MigratePreRowSaveEvent($migration, $message_service, $row);
    $this->assertSame($row, $event->getRow());
  }

}
