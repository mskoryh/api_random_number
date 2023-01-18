<?php

namespace App\Storage;

/**
 * Simple storage based on php array
 */
final class PhpArrayStorage implements StorageInterface {

  /**
   * Path to storage file.
   *
   * @var string
   */
  private string $storageFile;

  /**
   * Data from storage.
   *
   * @var array
   */
  private array $data;

  /**
   * Construct instance
   *
   * @param string $storage_file
   *   Path to storage file.
   */
  public function __construct(string $storage_file) {
    $this->storageFile = $storage_file;
    if (!file_exists($storage_file)) {
      $this->data = [];
      $this->write();
      return;
    }
    include $storage_file;
    $this->data = $data;
  }

  /**
   * {@inheritdoc}
   */
  public function save(int $number) : int {
    $id = count($this->data);
    $this->data[$id] = $number;
    $this->write();
    return $id;
  }

  /**
   * {@inheritdoc}
   */
  public function find(int $id) : int|null {
    if (isset($this->data[$id])) {
      return $this->data[$id];
    }
    return null;
  }

  /**
   * Write php array to file.
   *
   * @throws Exception If file is not writable.
   */
  private function write() {
    $data = '<?php $data = ' . var_export($this->data, true) . ';';
    if (!file_put_contents($this->storageFile, $data)) {
      throw new \Exception("Can't write to storage file ($storage_file)");
    }
  }
}
