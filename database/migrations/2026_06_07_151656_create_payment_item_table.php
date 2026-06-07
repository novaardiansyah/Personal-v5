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
		Schema::create('payment_item', function (Blueprint $table) {
			$table->id();
			$table->string('item_code')->unique();
			$table->foreignId('payment_id')->constrained('payments')->cascadeOnDelete();
			$table->foreignId('item_id')->constrained('items')->cascadeOnDelete();
			$table->decimal('price', 25, 5)->default(0);
			$table->decimal('quantity', 25, 5)->default(1);
			$table->decimal('total', 25, 5)->default(0);
			$table->softDeletes();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('payment_item');
	}
};
