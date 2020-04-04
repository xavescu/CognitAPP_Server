<?php
require_once('model/DBFunctions.php');

abstract class Controlador {
  public function __construct() {

  }

  abstract public function serve();
}