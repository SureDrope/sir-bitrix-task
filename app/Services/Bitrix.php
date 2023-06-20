<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Bitrix
{
	/**
	 * Calls a Bitrix webhook.
	 *
	 * @param string $method The method to call.
	 * @param array $fields The fields to send in the request.
	 * @param array $params An optional array of parameters to send in the request.
	 */
	public function call(string $method, array $fields, array $params = [])
	{
		$response = Http::post(config('services.bitrix.webhook') . $method, [
			'fields' => $fields,
			'params' => $params,
		]);

		return $response;
	}
}
