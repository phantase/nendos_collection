<?php

class NewsEntity implements JsonSerializable
{
  protected $internalid;
  protected $title;
  protected $summary;
  protected $content;
  protected $authorid;
  protected $creationdate;
  protected $editorid;
  protected $editiondate;

  /**
   *
   *
   * @param  array $data The data to use to create
   */
  public function __construct(array $data) {
    // no internalid if we're creating
    if(isset($data['internalid'])) {
      $this->internalid = $data['internalid'];
    }

    $this->title        = $data['title'];
    $this->summary      = $data['summary'];
    $this->content      = $data['content'];
    $this->type         = $data['type'];
    $this->authorid     = $data['authorid'];
    $this->creationdate = $data['creationdate'];
    $this->editorid     = $data['editorid'];
    $this->editiondate  = $data['editiondate'];
  }

  public function getInternalid() {
    return $this->internalid;
  }

  public function getTitle() {
    return $this->title;
  }

  public function getSummary() {
    return $this->summary;
  }

  public function getContent() {
    return $this->content;
  }

  public function getType() {
    return $this->type;
  }

  public function getAuthorId() {
    return $this->authorid;
  }

  public function getCreationDate() {
    return $this->creationdate;
  }

  public function getEditorId() {
    return $this->editorid;
  }

  public function getEditionDate() {
    return $this->editiondate;
  }

  public function jsonSerialize() {
    return [
      'internalid' => $this->internalid,
      'title' => $this->title,
      'summary' => $this->summary,
      'content' => $this->content,
      'type' => $this->type,
      'authorid' => $this->authorid,
      'creationdate' => $this->creationdate,
      'editorid' => $this->editorid,
      'editiondate' => $this->editiondate,
    ];
  }

}
