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
        Schema::create('reimbursement_logs', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->uuid('reimbursement_id')->nullable();
            $table->enum('status', ['pending', 'terima', 'tolak'])->default('pending');
            $table->text('reason')->nullable();
            $table->uuid('employee_user_id')->nullable();
            $table->timestamps();

            $table->foreign('reimbursement_id')
                ->references('id')
                ->on('reimbursements')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->foreign('employee_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reimbursement_logs');
    }
};
