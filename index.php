<?php
require 'class.pagseguro.php';

$assina = new pagSeguro();
echo $assina->pay();
