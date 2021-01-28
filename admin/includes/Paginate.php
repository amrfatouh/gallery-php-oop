<?php

class Paginate
{

  public $currentPage;
  public $itemsPerPage;
  public $itemsTotalCount;

  function __construct($currentPage = 1, $itemsPerPage = 4, $itemsTotalCount = 0)
  {
    $this->currentPage = (int)$currentPage;
    $this->itemsPerPage = (int)$itemsPerPage;
    $this->itemsTotalCount = (int)$itemsTotalCount;
  }

  public function previous()
  {
    return $this->currentPage - 1;
  }
  public function next()
  {
    return $this->currentPage + 1;
  }
  public function hasPrevious()
  {
    return $this->currentPage > 1;
  }
  public function hasNext()
  {
    return $this->currentPage < $this->totalPages();
  }

  public function totalPages()
  {
    return ceil($this->itemsTotalCount / $this->itemsPerPage);
  }

  public function offset()
  {
    return ($this->currentPage - 1) * $this->itemsPerPage;
  }

  public function findItems()
  {
    Database::escapeObjProps($this);
    $sql = "SELECT * FROM photos LIMIT {$this->itemsPerPage} OFFSET {$this->offset()}";
    $rows = Database::query($sql);
    $objects = [];
    if (!empty($rows)) {
      foreach ($rows as $row) {
        $rowData = [];
        foreach ($row as $value) {
          $rowData[] = $value;
        }
        $objects[] = Photo::constructInstance(...$rowData);
      }
    }
    return $objects;
  }
}
