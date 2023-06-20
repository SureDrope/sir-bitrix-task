@extends('components.layout')

@section('content')



<div class="flex justify-center items-center h-screen bg-blue-200">
	<div class="bg-blue-300 rounded-lg p-8">
		@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
		<form action="/" method="POST">
			@csrf
			<div class="mb-4">
				<input type="text" name="full_name" placeholder="ФИО" pattern="[А-Яа-яЁё]+\s[А-Яа-яЁё]+\s[А-Яа-яЁё]+"
					value="{{ old('full_name') }}" required
					class="w-full px-4 py-2 rounded-lg border border-blue-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
			</div>
			<div class="mb-4">
				<input type="date" name="birthdate" id='birthdate' placeholder="Дата рождения" required
					value="{{ old('birthdate') }}"
					class="w-full px-4 py-2 rounded-lg border border-blue-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500">

			</div>
			<div class="mb-4">
				<input type="tel" name="phone" placeholder="Телефон" required value="{{ old('phone') }}"
					class="w-full px-4 py-2 rounded-lg border border-blue-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
			</div>
			<div class="mb-4">
				<input type="email" name="email" placeholder="Электронная почта	" required value="{{ old('email') }}"
					class="w-full px-4 py-2 rounded-lg border border-blue-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
			</div>
			<div class="mb-4">
				<textarea name="comment" placeholder="Комментарий"
					class="w-full px-4 py-2 rounded-lg border border-blue-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{{ old('comment') }}}</textarea>
			</div>
			<div>
				<button type="submit"
					class="w-full px-4 py-2 rounded-lg bg-blue-500 text-white font-semibold hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
					Отправить
				</button>
			</div>
		</form>
	</div>
</div>

@endsection