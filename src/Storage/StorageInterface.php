<?php

namespace App\Storage;

/**
 * Storage for numbers
 */
interface StorageInterface {

  /**
   * Save number to storage
   *
   * @param int $number
   *   Number for save
   *
   * @return int
   *   Id of saved number
   */
  public function save(int $number) : int;

  /**
   * Find number by id.
   *
   * @param int $id
   *   Identifier of number in storage.
   *
   * @return int|null
   *   Number if exist or null if not exists.
   */
  public function find(int $id): int|null;
}
