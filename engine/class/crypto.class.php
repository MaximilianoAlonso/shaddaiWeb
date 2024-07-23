<?php

class Crypto
{
    var $data;
    public function encrypt($data) {
      $blocksize = 16;
      $pad = $blocksize - (strlen($data) % $blocksize);
      $data = $data . str_repeat(chr($pad), $pad);
      return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, DBKEY, $data, MCRYPT_MODE_CBC, DBIV));
    }
    public function decrypt($data) {
     $blocksize = 16;
     $pad = $blocksize - (strlen($data) % $blocksize);
     $data = $data . str_repeat(chr($pad), $pad);
     $decode = base64_decode($data);
     return mcrypt_decrypt(MCRYPT_RIJNDAEL_128, DBKEY, $decode, MCRYPT_MODE_CBC, DBIV);
   }
}
$crypto = new Crypto();

?>