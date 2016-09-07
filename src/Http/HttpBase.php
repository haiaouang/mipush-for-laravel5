<?php namespace Hht\MiPush\Http;

class HttpBase
{
	/**
     * @var Http request address
     */
	protected $url;

	/**
     * @var Http request header
     */
	protected $header;

	/**
     * @var Http request timeout
     */
	protected $timeout;

	/**
     * HttpBase constructor.
     * @param String     $url
	 * @param Array      $header
	 * @param Int        $timeout
     */
    function __construct($url = '', $header = [], $timeout = 30) {
		$this->url = $url;
		$this->header = $header;
		$this->timeout = $timeout;
    }

	/**
     * HttpBase request.
     * @param   String     $url
	 * @param   Array      $data
	 * @param   Array      $header
	 * @param   Int        $timeout
	 * @return  String
     */
	public function request($url = '', $data = [], $header = [], $timeout = 30) {
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, $timeout); 

		$response = curl_exec($ch);

		if ($error = curl_error($ch)) {
			//die($error);
		}

		curl_close($ch);

		return $response;
	}

	/**
     * HttpBase post result.
     * @param   Array      $fields
	 * @param   Int        $retries
	 * @param   String     $url
	 * @param   Array      $header
	 * @param   Int        $timeout
	 * @return  Result
     */
	public function postResult($url = '', $fields, $retries = 1, $header = [], $timeout = 0) {
		$url = $url ? $url : $this->url;
		$header = $header ? $header : $this->header;
		$timeout = $timeout ? $timeout : $this->timeout;

		$result = new Result($this->request($url, $fields, $header, $timeout));
		if($result->getErrorCode() == ErrorCode::Success)
		{
		    return $result;
		}

		for($i = 0; $i < $retries; $i ++) 
		{
			$result = new Result($this->request($url, $fields, $header, $timeout));
		    if ($result->getErrorCode() == ErrorCode::Success) break;
		}

		return $result;
	}
}


