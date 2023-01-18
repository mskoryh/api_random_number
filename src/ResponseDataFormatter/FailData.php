<?php

namespace App\ResponseDataFormatter;

/**
 * Fail response data
 */
class FailData extends ResponseData implements ResponseDataFormatterInterface {

  /**
   * Construct FailData instance
   *
   * @param string $message
   *   The response message.
   * @param array $data
   *   The reponse data.
   */
  public function __construct(string $message, array $data = [] ) {
    parent::__construct(false, $message, $data);
  }

}
