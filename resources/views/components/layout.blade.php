<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bitrix Lead Form</title>
	@vite('resources/css/app.css')
</head>

<body>
	<div class="min-h-screen bg-blue-200">
		<div class="container mx-auto px-4 py-8">
			@yield('content')
		</div>
	</div>

	<script src="{{ asset('js/app.js') }}"></script>
	@stack('scripts')
</body>

</html>