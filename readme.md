# Gallery Project

## Overview

This is a content management system where you can upload, edit and delete photos. Users can register in the website to add comments to your photos and can add your photos as profile pictures. Admins can track all photos, users, comments through their admin panel where data is shown in graphical and tabular formats.

![gallery_view](markdown/gallery_showing.gif)

---

## Technologies Used:

- PHP
- OOP
- MYSQL
- Javascript
- Fetch API
- PHPMailer
- Bootstrap

## Breaking Up The Code

### Overview

This project consists of a number of classes and main view files. It consists of 7 classes which are:

1. [DbObject Class](admin/includes/DbObject.php): represents any table in the database. It provides basic CRUD functions for any table. It's the parent of other classes in which each of them is dedicated for only one table.
1. [User Class](admin/includes/user.php): represents users table in database.
1. [Photo Class](admin/includes/Photo.php): represents photos table in database.
1. [Comment Class](admin/includes/Comment.php): represents comments table in database.
1. [Database Class](admin/includes/database.php): contains some helper methods related to database like querying and escaping words.
1. [Session Class](admin/includes/session.php): contains some helper methods that deal with data stored in `$_SESSION` super global variable like logged in user and notifications.
1. [Paginate Class](admin/includes/Paginate.php): contains some helper methods that help with pagination like limiting photos from database based on constraints set in the page and dealing with navigation through pages.

It also consists of 6 main views:

1. [Home Page](index.php): contains all photos in the gallery where you can navigate through pages of photos.
2. [Photo Detail Page](photo.php): contains details and comments on a photo and users can comment on that page.
3. [Admin Dashboard](admin/index.php): contains some statistics on data in the site like photos, registered users and posted comments.
4. [Admin Users List](admin/users.php): contains the details of all registered users in the site.
5. [Admin Photos List](admin/photos.php): contains details about all photos in the site.
6. [Admin Comments List](admin?comments.php): contains details about all posted comments in the site. It can also view comments posted on a specific photo.

These are the main files that build the site. There are other small view files like [Edit User](admin/edit_user.php) and [Upload Photo](admin/upload.php) and controlling files like [Delete Photo](admin/delete_photo.php) and others. There is also [Javascript File](admin/js/scripts.js) which contains some `fetch()` API code that fetches some data from the server with requests that are handled in a [specific file](admin/fetch_api.php) deticated for those fetch API requests.

In the next sections, we will go deeper in the details of each class as they are the main building blocks of the site.

### [DbObject Class](admin/includes/DbObject.php)

It consists of CRUD methods for all tables in the database and here are all the properties and methods of the class:

#### Properties

1. `static $table`: holds the value of the specific table that the class do its CRUD operations on. This property must be set by the child class.
2. `static $className`: holds the child class name. Used in `findByProperty()` method to check if the property exists in the class of not.
3. `static $integerProps`: an array which holds the name of child class integer properties. Used by `findByProperties()` method also so that it determines whether it puts single quotations around values it put in the query or not.

#### Methods

1. `constructInstance()`: used to return a new object of a specific type according to the child class that called the method (`User`, `Photo`, `Comment`). This method was used to add more flexibility to constructing new instances as you can't make more than one constructor.
2. `create()`: used to insert a new row to a specific table at the database.
3. `update()`: used to update a row in a specific table in the database.
4. `save()`: used to either create or update a row based on the existance of that row in the database.
5. `delete()`: used to remove a row from specific table in the database.
6. `findAllRows()`: used to select all rows from a specific table in the database.
7. `findById($id)`: used to select a specific row from a specific table from the database based on its id.
8. `findRandomRows($limit)`: used to select a number of rows from specific table in the database.
9. `findByProperty($propertyName, $propertyValue)`: used to select a row from a specific table from the database based on a specific property.
10. `totalCount()`: get the total count of rows in a specific table in the database.

### [User Class](admin/includes/user.php)

#### Properties

1. `static $table`: holds the name of users table in the database to be used in CRUD methods in `DbObject` class.
2. `static $className`: holds the name of `User` class to be used in `DbObject` class in `findByProperty()` method.
3. `static $integerProps`: holds the name of integer properties in `User` class to be userd in `DbObject` class in `findByProperty()` method.
4. `static $uploadDirectory`: contains the path of the user image from root directory.
5. static `$imagePlaceholder`: contains an image from the internet to be placed instead of user images when there are no images in the gallery.
6. `$id`: user id in the database.
7. public $id;
8. `$username`: user username in the database.
9. `$email`: user email in the database.
10. `$password`: user password in the database.
11. `$first_name`: user first_name in the database.
12. `$last_name`: user last_name in the database.
13. `$role`: user role in the database.
14. `$image`: user image in the database.
15. `$token`: user token in the database.

#### Methods

1. `static constructInstance()`: explained in `DbObject` class.
2. `getImagePath()`: returns image path **as viewed in the browser** in order to be used by images displayed in pages. If the user has no image, it returns the value of `$imagePlaceholder` property
3. `getImageActualPath()`: get the path of the image on the server. If user has no image, it also returns `$imagePlaceholder` property.
4. `verifyUser($username, $passwword)`: checks if the user is in the database or not and checks also if the password match the username or not.
5. `updateImage($photo_id)`: stores the `$filename` property of the photo whose id is passed to thit method in the `$image` property of the user.
6. `getRelatedComments()`: returns an array of comments which have that specific user id in their `$user_id` property.
7. `deleteRelatedComments()`: deletes all related comments from the database.

## Showing Extra Features

1. Commenting & loggin in
   ![commenting](markdown\normal_user_commenting.gif)

2. Creating & Deleting users
   ![creating and deleting users](markdown\admin_creating_deleting_user.gif)

3. Editing users
   ![editing user](markdown\admin_editing_user.gif)

4. Uploading photos
   ![uploading photos](markdown\admin_uploading_photo.gif)

5. Viewing and Deleting comments
   ![viewing and deleting comments](markdown\admin_showing_deleting_comment.gif)
