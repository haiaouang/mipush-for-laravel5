<?php namespace Hht\MiPush;

use Illuminate\Config\Repository;
use Illuminate\Support\Facades\Config;
use Hht\MiPush\Http\Sender;
use Hht\MiPush\Http\Builder;
use Hht\MiPush\Http\IOSBuilder;

class MiPush extends Sender
{
	/**
     * @var Client
     */
	protected $client;

	/**
     * MiPush constructor.
     */
    public function __construct() {
		parent::__construct();
    }
	
	public function setClient($client = 'android') {
		$this->client = $client;
		if ($this->client == 'ios')
			$this->header = ['Authorization: key=' . Config::get('mipush.ios.app_secret'), 'Content-Type: application/x-www-form-urlencoded'];
		else
			$this->header = ['Authorization: key=' . Config::get('mipush.android.app_secret'), 'Content-Type: application/x-www-form-urlencoded'];
	}

	public function getMessage() {
		if ($this->client == 'ios')
			return new IOSBuilder();
		else
			return new Builder();
	}
}
