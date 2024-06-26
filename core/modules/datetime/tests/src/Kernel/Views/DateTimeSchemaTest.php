<?php

declare(strict_types=1);

namespace Drupal\Tests\datetime\Kernel\Views;

use Drupal\Tests\SchemaCheckTestTrait;
use Drupal\views\Views;

/**
 * Tests the Drupal\datetime\Plugin\views schemas.
 *
 * @group datetime
 */
class DateTimeSchemaTest extends DateTimeHandlerTestBase {

  use SchemaCheckTestTrait;

  /**
   * {@inheritdoc}
   */
  public static $testViews = ['test_argument_datetime', 'test_filter_datetime', 'test_sort_datetime'];

  /**
   * Tests argument plugin schema.
   */
  public function testDateTimeSchema(): void {
    // Test argument schema.
    $view = Views::getView('test_argument_datetime');
    $view->initHandlers();
    $view->setDisplay('default');
    $arguments = $view->displayHandlers->get('default')->getOption('arguments');
    $arguments['field_date_value_year']['date'] = 'Date';
    $view->displayHandlers->get('default')->overrideOption('arguments', $arguments);
    $view->save();
    $this->assertConfigSchemaByName('views.view.test_argument_datetime');

    // Test filter schema.
    $view = Views::getView('test_filter_datetime');
    $view->initHandlers();
    $filters = $view->displayHandlers->get('default')->getOption('filters');
    $filters['field_date_value']['type'] = 'date';
    $view->displayHandlers->get('default')->overrideOption('filters', $filters);
    $view->save();
    $this->assertConfigSchemaByName('views.view.test_filter_datetime');

    // Test sort schema.
    $view = Views::getView('test_sort_datetime');
    $view->initHandlers();
    $sorts = $view->displayHandlers->get('default')->getOption('sorts');
    $this->assertNotEmpty($sorts['field_date_value']['granularity']);
    $this->assertConfigSchemaByName('views.view.test_sort_datetime');
  }

}
