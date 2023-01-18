<?php

namespace App\Http;

/**
 * Http response interface.
 */
interface ResponseInterface {

  /**
   * Set http code for response.
   *
   * @param int $code
   *   http code of response.
   */
  public function setStatusCode(int $code);

  /**
   * Get http code of response.
   *
   * @return int
   *   http code of response.
   */
  public function getStatusCode() : int;

  /**
   * Set body for response.
   *
   * @param mixed $body
   *   Body of response
   */
  public function setBody($body);

  /**
   * Get body of response.
   *
   * @return string
   *   Body of response.
   */
  public function getBody(): string;

  /**
   * Add header to response headers.
   *
   * @param string $name
   *   Header name.
   * @param string $value
   *   Header value.
   */
  public function setHeader(string $name, string $value);

  /**
   * Get headers of response.
   *
   * @return array
   *   All headers of response as key/value array. Where key is header name
   *   and value is header value.
   */
  public function getHeaders() : array;

}


