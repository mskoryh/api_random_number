<?php

namespace App;

use App\Http\Request;
use App\Http\JsonResponse;
use App\Http\ResponseInterface;
use App\Container\Container;
use App\ResponseDataFormatter\FailData;

final class Kernel {

  /**
   * App container
   *
   * @var App\Container\Container
   */
  private static Container $container;

  /**
   * Create new instanct
   *
   * @param App\Container\Container $container
   *   The app container.
   */
  public function __construct(Container $container) {
    self::$container = $container;
  }

  /**
   * Get item from app container
   *
   * @param mixed $id
   *   Id of item in container.
   *
   * @return mixed
   *   Item from container
   */
  public static function container($id) {
    return self::$container->get($id);
  }

  /**
   * Process request.
   *
   * @param App\Http\Request
   *   The http request object.
   *
   * @return App\Http\ResponseInterface
   *   The http response object.
   */
  public function handle(Request $request) : ResponseInterface {
    try {
      $response = self::container('router')->dispatch($request);
    }
    catch(\Exception $e) {
      $response = new JsonResponse(500, (new FailData('Internal server error.'))->toArray());
    }

    return $response;
  }

  /**
   * Send request to client.
   *
   * @param App\Http\ResponseInterface $response
   *   The http response object.
   */
  public function sendResponse(ResponseInterface $response) {
    http_response_code($response->getStatusCode());
    foreach ($response->getHeaders() as $name => $value) {
      header("$name: $value");
    }
    file_put_contents('php://output', $response->getBody());
  }

}
