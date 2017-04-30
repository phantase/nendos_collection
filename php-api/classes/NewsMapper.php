<?php

class NewsMapper extends Mapper
{
  protected $tablename = "news";

  public function get() {
    $sql = "SELECT n.internalid, n.title, n.summary, n.content, n.type, n.authorid, n.creationdate, n.editorid, n.editiondate
            FROM news n";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute();

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new NewsEntity($row);
    }
    return $results;
  }

  public function getByInternalid($news_internalid) {
    $sql = "SELECT n.internalid, n.title, n.summary, n.content, n.type, n.authorid, n.creationdate, n.editorid, n.editiondate
            FROM news n
            WHERE n.internalid = :news_internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["news_internalid" => $news_internalid]);

    if($row = $stmt->fetch()) {
      return new NewsEntity($row);
    }
  }

  public function create(NewsEntity $news, $userid) {
    $sql = "INSERT INTO news
              (title, summary, content, type, authorid, creationdate, editorid, editiondate) VALUES
              (:title, :summary, :content, :type, :userid, NOW(), :userid, NOW())";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute([
        "title" => $news->getTitle(),
        "summary" => $news->getSummary(),
        "content" => $news->getContent(),
        "type" => $news->getType(),
        "userid" => $userid
      ]);
    if(!$result) {
      throw new Exception("Could not save news");
    }
    return $this->getByInternalid($newsid);
  }

  public function update(NewsEntity $news, $userid) {
    $sql = "UPDATE news SET
              title = :title,
              summary = :summary,
              content = :content,
              type = :type,
              editorid = :userid,
              editiondate = NOW()
            WHERE internalid = :internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute([
        "internalid" => $news->getInternalId(),
        "title" => $news->getTitle(),
        "summary" => $news->getSummary(),
        "content" => $news->getContent(),
        "type" => $news->getType(),
        "userid" => $userid
      ]);
    if(!$result) {
      throw new Exception("Could not update news");
    }
    return $this->getByInternalid($news->getInternalId());
  }
}
