<?php

namespace App\Router;

use App\Http\Request;
use App\Http\ResponseInterface;
use App\Http\JsonResponse;

/**
 * The router for match request and controller.
 */
final class Router {

  /**
   * Defined routes. Example:
   * @code
   *  $routes = [
   *    '{http_method}' => [
   *      '{route_regex}' => '{callback}',
   *    ],
   *  ];
   * @code
   *
   * {http_method} - is http method like 'get' or 'post'
   * {route_regex} - is regex pattern for url
   * {callback} - is any callable, E.x. function
   *
   * @var array
   */
  private array $routes;

  /**
   * Add route.
   *
   * @param string $method
   *   The http method for route, E.x. get or post.
   * @param string $url
   *   The url pattern for match with request.
   * @param callable $callback
   *   The callback wich will be invoke for matched request.
   */
  public function addRoute(string $method, string $url, callable $callback): void {
    $regex = $this->buildRouteRegex($url);
    $this->routes[$method][$regex] = $callback;
  }

  /**
   * Dispatch request to matched callback or return 404 response.
   *
   * @param App\Http\Request $request
   *   The http request.
   *
   * @return App\Http\ResponseInterface
   *   The http response.
   */
  public function dispatch(Request $request) : ResponseInterface {
    $parameters = [];
    $callback = function () {
      $response = new JsonResponse(404, ['message' => 'Not found']);
      return $response;
    };

    $method = $request->getMethod();
    $routes_regex = array_keys($this->routes[$method]);
    $url = $request->getUrl();
    foreach($routes_regex as $regex) {
      if (preg_match($regex, $url, $parameters)) {
        array_shift($parameters);
        $callback = $this->routes[$method][$regex];
        break;
      }
    }
    return $callback($request, ...$parameters);
  }

  /**
   * Helper build regex for url.
   *
   * @param string $url
   *   The url.
   *
   * @return string
   *   Regex for url.
   */
  private function buildRouteRegex(string $url) : string {
    $path_fragments = explode('/', $url);
    $regex_fragments = [];
    foreach ($path_fragments as $path_fragment) {
      if (substr($path_fragment, 0, 1) === '{' && substr($path_fragment, -1, 1) === '}') {
        $regex_fragments[] = '([a-zA-Z0-9_-]+)';
        continue;
      }
      $regex_fragments[] = $path_fragment;
    }
    $regex = '/' . implode('\/', $regex_fragments) . '/';
    return $regex;
  }
}
