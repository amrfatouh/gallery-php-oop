<?php

class Comment extends DBObject
{

  static protected $table = "comments";
  static protected $className = "Comment";
  static protected $integerProps = ["id", "photo_id", "user_id"];

  public $id;
  public $photo_id;
  public $user_id;
  public $body;
  public $date;

  public static function constructInstance($id = null, $photo_id = null, $user_id = null, $body = null, $date = null)
  {
    $comment = new Comment;
    $comment->id = $id;
    $comment->photo_id = $photo_id;
    $comment->user_id = $user_id;
    $comment->body = $body;
    $comment->date = $date;
    return $comment;
  }

  public function getUser()
  {
    if (!$this->user_id) return false;
    return User::findById($this->user_id);
  }
}
