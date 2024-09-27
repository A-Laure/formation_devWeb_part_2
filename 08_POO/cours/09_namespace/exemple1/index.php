<?php

use App\Blog\Message;
use App\Blog\Post;
use App\Contact\Message as ContactMessage;

require 'BlogMessage.php';
require 'BlogPost.php';
require 'contact/ContactMessage.php';


$blog = new Message;
$blogPost = new Post;
$contact = new ContactMessage;
