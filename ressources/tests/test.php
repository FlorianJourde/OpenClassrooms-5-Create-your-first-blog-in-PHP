<?php

function test() {
  try {
    throw new Exception(('Ma seconde exception'));
  echo "Je continue";
  } catch (Exception $exception) {
    throw new Exception(('Ma troisième exception'));

    die($exception->getMessage());
  }

  throw new Exception(('Mon exception depuis une fonction'));
}

try {
//  test();

//  echo "Je continue";
} catch (Exception $exception) {
//  die($exception->getMessage());
}

try {
  try {
    throw new Exception('Une première exception');
  } catch (Exception $e) {
    try {
    } catch (Exception $e) {
      throw new Exception('Une seconde exception');
    }
    throw new Exception('Une troisième exception');
  }
  throw new Exception('Une quatrième exception');
} catch (Exception $e) {
  echo $e->getMessage();
}