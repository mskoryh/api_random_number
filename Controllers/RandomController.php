<?php

namespace Controller;

use App\Http\Request;
use App\Http\JsonResponse;
use App\Kernel as App;
use Resource\NumberResource;
use App\ResponseDataFormatter\SuccessData;
use App\ResponseDataFormatter\FailData;

final class RandomController {

  /**
   * Generate random number
   *
   * @param App\Http\Request
   *   The http request object.
   *
   * @return App\Http\ResponseInterface
   *   The http response object.
   */
  public function generate(Request $request) {
    $data = json_decode($request->getBody());
    $min = isset($data->min) ? $data->min : 0;
    $max = isset($data->max) ? $data->max : PHP_INT_MAX;
    $number = rand($min, $max);

    $id = App::container('storage')->save($number);

    $number_resource = new NumberResource($id, $number);
    $current_time = gmdate('D, d m Y h:i:s ') . 'GMT';
    $headers = [
      'Expires' => $current_time,
      'Last-Modified' => $current_time,
      'Cache-Control' => 'no-cache, must-revalidate',
      'Pragma' => 'no-cache'
    ];
    return new JsonResponse(201, (new SuccessData($number_resource->toArray()))->toArray(), $headers);
  }

  /**
   * Get number by id
   *
   * @param App\Http\Request
   *   The http request object.
   * @param int $id
   *   Id for stored number.
   *
   * @return App\Http\ResponseInterface
   *   The http response object.
   */
  public function retrive(Request $request, $id) {
    if (!is_numeric($id)) {
      return new JsonResponse(400, (new FailData('Id must be integer.'))->toArray());
    }
    $number = App::container('storage')->find($id);
    if (is_null($number)) {
      return new JsonResponse(404, (new FailData('Resouce not found'))->toArray());
    }
    $number_resource = new NumberResource($id, $number);
    return new JsonResponse(200, (new SuccessData($number_resource->toArray()))->toArray());
  }

}
