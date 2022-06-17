<?php
// controllers/homepage.php

//require_once('src/model.php');
require_once('src/model/post.php');

function homepage()
{
//  $posts = getPosts();
  $postRepository = new PostRepository();
  $posts = $postRepository->getPosts();

  require('templates/homepage.php');
}