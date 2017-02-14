<?php

abstract class Mapper {

  protected $db;

  public function __construct($db) {
    $this->db = $db;
  }

  protected $tablename;

  public function count() {
    $sql = "SELECT count(*) AS count FROM ".$this->tablename;
    $stmt = $this->db->query($sql);
    return $stmt->fetch();
  }

}
