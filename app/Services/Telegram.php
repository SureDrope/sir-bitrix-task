<?php

namespace App\Services;

class Telegram
{
	private string $telegram_api_link;

	public function __construct(string $telegram_bot_token)
	{
		$this->telegram_api_link = 'https://api.telegram.org/bot' . $telegram_bot_token . '/';
	}
	/**
	 * Sends a message to the Telegram chat using its id
	 *
	 * @param string $message
	 * @param string $chatId
	 *
	 * @return void
	 */
	public function sendMessageToChat(string $message, string $chatId): void
	{
		$queryParameters = [
			'chat_id' => $chatId,
			'text' => $message,
		];
		$url = $this->telegram_api_link . 'sendMessage?' . http_build_query($queryParameters);
		file_get_contents($url);
	}
}
