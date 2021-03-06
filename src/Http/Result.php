<?php namespace Hht\MiPush\Http;

class Result {
	
	/**
     * @var Error code
     */
	private $errorCode;
	/**
     * @var Data raw
     */
	private $raw;
	
	public function __construct($jsonStr){
		$data = json_decode($jsonStr, true);
		$this->raw = $data;
		$this->errorCode = $data['code'];
	}
	
	/**
     * HttpBase getErrorCode.
	 * @return  String
     */
	public function getErrorCode(){
		return $this->errorCode;
	}
	
	/**
     * HttpBase getRaw.
	 * @return  Array
     */
	public function getRaw(){
		return $this->raw;
	}
}

?>
