<?php

use App\ColocationStatus;
use App\UsersColectionRoles;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('memberships', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->enum('role', array_map( fn($case) => $case->value , UsersColectionRoles::cases()));
            $table->enum('status', array_map(fn($case) => $case->value, ColocationStatus::cases()));
            $table->uuid('user_id');
            $table->uuid('colocation_id');
            $table->foreign('colocation_id')->references('id')->on('colocations')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
