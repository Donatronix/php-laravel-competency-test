<?php

use App\Enums\PaymentMethodStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('user_payment_method', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');

            $table->uuid('payment_method_id');

            $table->foreign('payment_method_id')->references('id')
                ->on('payment_methods')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedTinyInteger('status')->default(PaymentMethodStatus::INACTIVE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('user_payment_method');
    }
};
