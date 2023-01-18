<?php

namespace App\ResponseDataFormatter;

/**
 * Success response data
 */
class SuccessData extends ResponseData implements ResponseDataFormatterInterface {

  /**
   * Construct SuccesData instance
   *
   * @param array $data
   *   The reponse data.
   * @param string $message
   *   The response message.
   */
  public function __construct(array $data, string $message = '') {
    parent::__construct(true, $message, $data);
  }
}
