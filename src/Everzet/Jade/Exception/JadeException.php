<?php

namespace Everzet\Jade\Exception;

/*
 * This file is part of the Jade.php.
 * (c) 2010 Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Jade exception. 
 */
 

 
class JadeException extends \Exception
{

  const TOO_DEEP = 301;
  const NOT_EVEN = 302;

  var $line;

  private function setLineNumber($int) {
    $this->line = $int;
  }
  
  public function highlightContext($data) {
    $lines = explode("\n", $data);
    
    $offset = 3;
    $max = 5;
    $diff = $max - $offset;
    $context = array_slice($lines, (($start = $this->line - $offset) > 0 ? $start : 0), $max);
    
    echo "\n   ! " . $this->getMessage() . "\n\n";
    foreach ($context as $i => $line) {
      if ($diff == $i) {
        echo ' > # '; }
      else {
        echo '   # '; };
      echo $line . "\n";
    }
    echo "\n";
  }
  
  public function __construct($code, $line) {
    $JadeExceptionMSGs = array(
      301 => 'Indention too deep. Check spaces!',
      302 => 'Wrong Indention, must be multiple of 2. Check spaces!',
    );
    
    $this->setLineNumber($line);    
    
    // Insert rendert code as msg
    
    parent::__construct($JadeExceptionMSGs[$code], $code);
  }

}
