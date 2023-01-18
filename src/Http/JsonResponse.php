<?php

namespace App\Http;

/**
 * Json response with setted Content-type.
 */
class JsonResponse extends BaseResponse implements ResponseInterface {

  /**
   * Construct new Json response object
   *
   * @param int $status_code
   *   The http status code.
   * @param array|object $body
   *   The response body.
   * @param array $headers
   *   The response headers as key/value array, where key is header name and
   *   value is header value.
   */
  public function __construct(int $status_code = 200, array|object $body = [], array $headers = []) {
    foreach(array_keys($headers) as $header) {
      if (trim(strtolower($header)) === 'content-type') {
        throw new \Exception('Don\'t allow set Content-type header for JsonResponse.');
      }
    }
    $headers['Content-Type'] = 'application/json';
    parent::__construct($status_code, json_encode($body), $headers);
  }

  /**
   * {@inheritdoc}
   */
  public function setHeader($key, $value) {
    if (trim(strtolower($key)) === 'content-type') {
      throw new \Exception('Could not change Content-type header for json response');
    }
    $this->headers[$key] = $value;
  }

  /**
   * Set body for json response.
   *
   * @param array|object $body
   *   Structured body for convert to json string.
   */
  public function setBody($body) {
    parent::setBody(json_encode($body));
  }

}
