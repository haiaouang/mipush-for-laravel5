<?php namespace Hht\MiPush\Http;

use Illuminate\Config\Repository;
use Illuminate\Support\Facades\Config;

class Sender extends HttpBase
{
	public function __construct(){
		parent::__construct();
	}

	public function send(Message $message, $regId, $retries = 1) {
		$fields = $message->getFields();
		$fields['registration_id'] = $regId;

		return $this->postResult(Config::get('mipush.urls.reg_url'), $fields, $retries);
	}

	public function sendToIds(Message $message, $regIds, $retries = 1) {
		$fields = $message->getFields();
		$fields['registration_id'] = implode(',', $regIds);

		return $this->postResult(Config::get('mipush.urls.reg_url'), $fields, $retries);
	}

	public function sendToAlias(Message $message, $alias, $retries = 1) {
		$fields = $message->getFields();
		$fields['alias'] = $alias;

		return $this->postResult(Config::get('mipush.urls.alias_url'), $fields, $retries);
	}

	public function sendToAliases(Message $message, $alias, $retries = 1) {
		$fields = $message->getFields();
		$fields['alias'] = implode(',', $alias);
		
		return $this->postResult(Config::get('mipush.urls.alias_url'), $fields, $retries);
	}

	public function broadcast(Message $message, $topic, $retries = 1) {
		$fields = $message->getFields();
		$fields['topic'] = $topic;

		return $this->postResult(Config::get('mipush.urls.topic_url'), $fields, $retries);
	}

	public function broadcastAll(Message $message, $retries = 1) {
		$fields = $message->getFields();
		
		return $this->postResult(Config::get('mipush.urls.all_url'), $fields, $retries);
	}

	public function checkScheduleJobExist($msgId, $retries = 1) {
		$fields['job_id'] = $msgId;

		return $this->postResult(Config::get('mipush.urls.exist_url'), $fields, $retries);
	}

	public function deleteScheduleJob($msgId) {
		$fields['job_id'] = $msgId;
		
		return $this->postResult(Config::get('mipush.urls.delete_url'), $fields, $retries);
	}
}


