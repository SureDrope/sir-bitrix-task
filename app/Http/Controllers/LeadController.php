<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Services\Bitrix;
use App\Services\Telegram;
use Illuminate\Http\Request;

class LeadController extends Controller
{
	public function show()
	{
		return view('form');
	}

	public function store(Request $request, Telegram $telegram, Bitrix $bitrix)
	{
		$validatedData = (array)$request->validate([
			'full_name' => ['required', 'max:255'],
			'birthdate' => ['required', 'date'],
			'phone' => ['required', 'phone:INTERNATIONAL,RU'],
			'email' => ['required', 'email'],
			'comment' => ['nullable', 'max:255']
		]);

		[$lastName, $name, $secondName] = explode(' ', $validatedData['full_name']);

		// Создание контакта
		$response = $bitrix->call(
			'crm.contact.add',
			[
				'NAME' => $name,
				'SECOND_NAME' => $secondName,
				'LAST_NAME' => $lastName,
				'BIRTHDATE' => $validatedData['birthdate'],
				'PHONE' => [['VALUE' => $validatedData['phone'], 'VALUE_TYPE' => 'WORK']],
				'EMAIL' => [['VALUE' => $validatedData['email'], 'VALUE_TYPE' => 'WORK']],
				'COMMENTS' => $validatedData['comment']
			],
			['REGISTER_SONET_EVENT' => 'Y']
		);
		// Проверка успешности создания контакта
		if (!$response->successful()) {
			return redirect()->back()->with('error', 'Не удалось создать контакт в битрикс');
		}

		$contactId = $response->json()['result'];

		// Создание лида
		$response = $bitrix->call(
			'crm.lead.add',
			[
				'CONTACT_ID' => $contactId,
				'TITLE' => 'Новый лид',
				'COMMENTS' => $validatedData['comment'],
			],
			['REGISTER_SONET_EVENT' => 'Y']
		);

		if (!$response->successful()) {
			return redirect()->back()->with('error', 'Не удалось создать лид в Битрикс24');
		}

		$leadId = $response->json()['result'];

		Lead::create(
			array_merge([
				'id' => $leadId,
				'contact_id' => $contactId,
			], $validatedData)
		);

		$message = '';
		foreach ($validatedData as $key => $value) {
			$message .= $key . ': ' . $value . PHP_EOL;
		}

		$telegram->sendMessageToChat($message, config('services.telegram.chat_id'));

		return redirect()->back()->with('success', 'Форма успешно отправлена');
	}
}
