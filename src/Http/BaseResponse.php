<?php

namespace App\Http;

/**
 * Base class for http responses.
 */
abstract class BaseResponse implements ResponseInterface {

  /**
   * The http code.
   *
   * @var int
   */
  protected int $statusCode;

  /**
   * The body of response.
   *
   * @var string
   */
  protected string $body;

  /**
   * The headers of response.
   *
   * @var array
   */
  protected array $headers;

  /**
   * Construct new response instance.
   *
   * @param int $status_code
   *   The http status code.
   * @param array|object $body
   *   The response body.
   * @param array $headers
   *   The response headers as key/value array, where key is header name and
   *   value is header value.
   */
  public function __construct(int $status_code = 200, string $body = '', array $headers = []) {
    $this->headers = $headers;
    $this->statusCode = $status_code;
    $this->body = $body;
  }

  /**
   * {@inheritdoc}
   */
  public function setStatusCode(int $code) {
    $this->statusCode = $code;
  }

  /**
   * {@inheritdoc}
   */
  public function getStatusCode() : int {
    return $this->statusCode;
  }

  /**
   * {@inheritdoc}
   */
  public function setBody($body) {
    $this->body = $body;
  }

  /**
   * {@inheritdoc}
   */
  public function getBody(): string {
    return $this->body;
  }

  /**
   * {@inheritdoc}
   */
  public function setHeader($name, $value) {
    $this->headers[$name] = $value;
  }

  /**
   * {@inheritdoc}
   */
  public function getHeaders() : array {
    return $this->headers;
  }

}

