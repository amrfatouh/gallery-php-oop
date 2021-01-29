<?php

class Comment extends DBObject
{

  static protected $table = "comments";
  static protected $className = "Comment";
  static protected $integerProps = ["id", "photo_id"];

  public $id;
  public $photo_id;
  public $author;
  public $body;
  public $date;

  public static function constructInstance($id = null, $photo_id = null, $author = null, $body = null, $date = null)
  {
    $comment = new Comment;
    $comment->id = $id;
    $comment->photo_id = $photo_id;
    $comment->author = $author;
    $comment->body = $body;
    $comment->date = $date;
    return $comment;
  }

  public function findRelatedComments($photo_id)
  {
    return Comment::findByProperty("photo_id", $photo_id);
  }
}
