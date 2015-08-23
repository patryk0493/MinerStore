<?php

define("SERVERDATA_EXECCOMMAND",2);
define("SERVERDATA_AUTH",3);

class RCon {
	var $Password;
	var $Host;
	var $Port = 27015;
	var $_Sock = null;
	var $_Id = 0;

	function RCon ($Host,$Port,$Password) {
		$this->Password = $Password;
		$this->Host = $Host;
		$this->Port = $Port;
		$this->_Sock = @fsockopen($this->Host,$this->Port, $errno, $errstr, 30) or
	    		die("Unable to open socket: $errstr ($errno)\n");
          $this->_Set_Timeout($this->_Sock,2,10);
    	}

	function Auth () {
		$PackID = $this->_Write(SERVERDATA_AUTH,$this->Password);

		$ret = $this->_PacketRead();
		if ($ret[1]['id'] == -1) {
			die("Authentication Failure\n");
		}
	}

	function _Set_Timeout(&$res,$s,$m=0) {
		if (version_compare(phpversion(),'4.3.0','<')) {
			return socket_set_timeout($res,$s,$m);
		}
		return stream_set_timeout($res,$s,$m);
	}

	function _Write($cmd, $s1='', $s2='') {
		$id = ++$this->_Id;

		$data = pack("VV",$id,$cmd).$s1.chr(0).$s2.chr(0);

		$data = pack("V",strlen($data)).$data;

		fwrite($this->_Sock,$data,strlen($data));

		return $id;
	}

	function _PacketRead() {
		$retarray = array();
		while ($size = @fread($this->_Sock,4)) {
			$size = unpack('V1Size',$size);
			if ($size["Size"] > 4096) {
				$packet = "\x00\x00\x00\x00\x00\x00\x00\x00".fread($this->_Sock,4096);
			} else {
				$packet = fread($this->_Sock,$size["Size"]);
			}
			array_push($retarray,unpack("V1ID/V1Response/a*S1/a*S2",$packet));
		}
		return $retarray;
	}

	function Read() {
		$Packets = $this->_PacketRead();

		foreach($Packets as $pack) {
			if (isset($ret[$pack['ID']])) {
				$ret[$pack['ID']]['S1'] .= $pack['S1'];
				$ret[$pack['ID']]['S2'] .= $pack['S1'];
			} else {
				$ret[$pack['ID']] = array(
					'Response' => $pack['Response'],
					'S1' => $pack['S1'],
					'S2' =>	$pack['S2'],
				);
			}
		}
		return $ret;
	}

	function sendCommand($Command) {
		$Command = '"'.trim(str_replace(' ','" "', $Command)).'"';
		$this->_Write(SERVERDATA_EXECCOMMAND,$Command,'');
	}

	function rconCommand($Command) {
		$this->sendcommand($Command);

		$ret = $this->Read();
		return $ret[0]['S1'];
	}
}
?>