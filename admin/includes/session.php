<?php

class Session
{
  public static function isLoggedIn()
  {
    return isset($_SESSION['user_id']);
  }

  public static function login($user)
  {
    $_SESSION['user_id'] = $user->id;
  }

  public static function logout()
  {
    unset($_SESSION['user_id']);
  }

  public static function addNotification($notification)
  {
    if (!isset($_SESSION['notifications']))
      $_SESSION['notifications'] = [$notification];
    else
      array_push($_SESSION['notifications'], $notification);
  }

  public static function emptyNotifications()
  {
    $_SESSION['notifications'] = [];
  }
}
