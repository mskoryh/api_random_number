<?php

namespace App\Container;

/**
 * Container for store items.
 */
final class Container {

  /**
   * Store data as key/value array.
   */
  private array $storage;

  /**
   * Add data to storage.
   *
   * @param mixed $key
   *   Key for store value.
   * @param mixed $value
   *   Value for store.
   */
  public function set($key, $value) {
    $this->storage[$key] = $value;
  }

  /**
   * Get stored item.
   *
   * @param mixed $key
   *   Key of stored item.
   *
   * @return mixed
   *   stored item
   */
  public function get($key) {
    return $this->storage[$key];
  }
}
