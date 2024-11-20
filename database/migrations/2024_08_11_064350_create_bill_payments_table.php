<?php

use App\Enums\GeneralStatus;
use App\Models\Bill;
use App\Models\PaymentAccount;
use App\Models\User;
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
        Schema::create('bill_payments', function (Blueprint $table) {
            $table->id();
            $table->longText('ref_no');
            $table->foreignIdFor(Bill::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(PaymentAccount::class)->constrained()->onDelete('cascade');
            $table->float('amount', 8, 2);
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->string('status')->default(GeneralStatus::PENDING->value);
            $table->longText('receipt');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_payments');
    }
};
