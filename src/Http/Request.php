<?php

namespace App\Http;

/**
 * Represents http request.
 */
final class Request {

  /**
   * The request headers.
   *
   * @var array
   */
  private array $headers;

  /**
   * The request method.
   *
   * @var string
   */
  private string $method;

  /**
   * The request url.
   *
   * @var string
   */
  private string $url;

  /**
   * The get parameters of request.
   *
   * @var array
   */
  private array $getParameters;

  /**
   * The post parameters of request.
   *
   * @var array
   */
  private array $postParameters;

  /**
   * The body of request.
   *
   * @var string
   */
  private string $body;

  /**
   * Construct new Request instance.
   *
   * @param array $headers
   *   The request headers.
   * @param string $method
   *   The request method.
   * @param string $url
   *   The request url.
   * @param array $get_parameters
   *   The get parameters of request.
   * @param array $post_parameters
   *   The post parameters of request.
   * @param string $body
   *   The body of request.
   */
  public function __construct(
      array $headers,
      string $method,
      string $url,
      array $get_parameters,
      array $post_parameters,
      string $body
      ) {
    foreach ($headers as $header => $value) {
      $this->headers[strtolower($header)] = $value;
    }
    $this->method = $method;
    $this->url = $url;
    $this->getParameters = $get_parameters;
    $this->postParameters = $post_parameters;
    $this->body = $body;
  }

  /**
   * Create request instance from php globals.
   *
   * @return App\Http\Request
   *   Created request object.
   */
  public static function fromGlobals() {
    $headers = getallheaders();
    $method = strtolower($_SERVER['REQUEST_METHOD']);
    $url = strtolower(isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '');
    $get_parameters = $_GET;
    $post_parameters = $_POST;
    $body = file_get_contents('php://input');

    $instance = new self($headers, $method, $url, $get_parameters, $post_parameters, $body);
    return $instance;
  }

  /**
   * Get request http method.
   *
   * @return string
   *   Request http method.
   */
  public function getMethod() {
    return $this->method;
  }

  /**
   * Get url of request.
   *
   * @return string
   *   Request url.
   */
  public function getUrl() {
    return $this->url;
  }

  /**
   * Get specific header of request.
   *
   * @param string $header_name
   *   Header name.
   * @param mixed $default
   *   This value will be returned if header name is not exists in request.
   *   Default null.
   *
   * @return string
   *   Request url.
   */
  public function getHeader(string $header_name, $default = null) {
    return $this->hasHeader($header_name) ? $this->headers[strtolower($header_name)] : $default;
  }

  /**
   * Check exist given header in request or not.
   *
   * @param string $header_name
   *   Header name.
   *
   * @return bool
   *   True if exists, False otherwhise.
   */
  public function hasHeader(string $header_name) : bool {
    return isset($this->headers[strtolower($header_name)]);
  }

  /**
   * Get request body.
   *
   * @return string
   *   The request body.
   */
  public function getBody() : string {
    return $this->body;
  }

}
