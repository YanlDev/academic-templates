<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Código de compra

            $table->foreignId('user_id')->constrained();
            $table->foreignId('template_id')->constrained();

            // Pago
            $table->string('transaction_id')->nullable();
            $table->decimal('amount', 8, 2);
            $table->string('payment_method');
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');

            // Control de descarga
            $table->integer('downloads_used')->default(0);
            $table->integer('downloads_limit')->default(3);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
