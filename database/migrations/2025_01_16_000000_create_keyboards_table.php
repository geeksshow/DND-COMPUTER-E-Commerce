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
        Schema::create('keyboards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->string('brand');
            $table->string('switch_type')->nullable(); // Mechanical, Membrane, etc.
            $table->string('layout')->default('Full Size'); // Full Size, TKL, 60%, etc.
            $table->string('connectivity')->default('Wired'); // Wired, Wireless, Bluetooth
            $table->boolean('rgb_lighting')->default(false);
            $table->string('color')->default('Black');
            $table->integer('stock_quantity')->default(0);
            $table->string('image')->nullable();
            $table->json('images')->nullable(); // Multiple images
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keyboards');
    }
};