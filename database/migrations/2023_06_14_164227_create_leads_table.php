<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('leads', function (Blueprint $table) {
			$table->unsignedBigInteger('id');
			$table->unsignedBigInteger('contact_id');
			$table->string('full_name');
			$table->date('birthdate');
			$table->string('phone');
			$table->string('email');
			$table->text('comment');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('leads');
	}
};
