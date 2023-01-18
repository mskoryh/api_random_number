<?php

namespace App\ResponseDataFormatter;

/**
 * Format response data
 */
class ResponseData implements ResponseDataFormatterInterface {

  /**
   * The response message.
   *
   * @var string
   */
  protected string $message;

  /**
   * The response data.
   *
   * @var array
   */
  protected array $data;

  /**
   * The response status.
   *
   * @var bool
   */
  protected bool $status;

  /**
   * Construct ResponseData instance
   *
   * @param bool $status
   *   The response status.
   * @param string $message
   *   The response message.
   * @param array $data
   *   The reponse data.
   */
  public function __construct(bool $status, string $message = '', array $data = []) {
    $this->status = $status;
    $this->message = $message;
    $this->data = $data;
  }

  /**
   * {@inheritdoc}
   */
  public function toArray() : array {
    $formatted_data = [];
    $formatted_data['status'] = $this->status ? 'success' : 'fail';
    if (!empty($this->message)) {
      $formatted_data['message'] = $this->message;
    }
    if (!empty($this->data)) {
      $formatted_data['data'] = $this->data;
    }

    return $formatted_data;
  }
}
