<?php

namespace App\ResponseDataFormatter;

/**
 * Format response body.
 */
interface ResponseDataFormatterInterface {

  /**
   * Export data as array
   *
   * @return array
   *   Structured data for response.
   */
  public function toArray() : array;

}
