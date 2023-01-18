<?php

namespace Resource;

final class NumberResource {

  /**
   * Number id
   *
   * @var int
   */
  protected int $id;

  /**
   * Number
   *
   * @var int
   */
  protected int $number;

  /**
   * Create new instance.
   *
   * @param int $id
   *   The id of numnber.
   * @param int $number
   *   The number.
   */
  public function __construct(int $id, int $number) {
    $this->id = $id;
    $this->number = $number;
  }

  /**
   * Transform resource to array
   *
   * @return array
   *   NumberResource as array.
   */
  public function toArray() : array {
    return [
      'id' => $this->id,
      'number' => $this->number,
    ];
  }

  /**
   * Transform resource to json
   *
   * @return string
   *   NumberResource as json string.
   */
  public function toJson() : string {
    return json_encode($this->toArray());
  }
}
