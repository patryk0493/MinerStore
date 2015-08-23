<?php
include_once("rcon/rcon_class.php");

class minecraftRcon extends RCon{
    
    public function mcSendCommand($cmd){
      $this->_Write(SERVERDATA_EXECCOMMAND,$cmd,'');
    }

   function mcRconCommand($cmd) {
   $this->mcSendCommand($cmd);
   }
}
?>