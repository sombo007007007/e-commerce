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
        Schema::create('role_role_account_clinets', function (Blueprint $table) {
            $table->unsignedBigInteger('account_clinet_id');
            $table->unsignedBigInteger('role_clinet_id');
            $table->primary(['account_clinet_id', 'role_clinet_id']);
            $table->foreign('account_clinet_id')->references('id')->on('account_clinet')->onDelete('cascade');
            $table->foreign('role_clinet_id')->references('id')->on('role_clinet')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_role_account_clinets');
    }
};
