<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStencilPriceBaseRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stencil_price_base_rules', function (Blueprint $table) {
            $table->id();
            $table->string('frame_type');
            $table->unsignedDecimal('width_mm', 8, 2);
            $table->unsignedDecimal('height_mm', 8, 2);
            $table->unsignedDecimal('thickness_mm', 8, 2);
            $table->unsignedDecimal('price', 12, 4);
            $table->string('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->datetime('created_at')->useCurrent();
            $table->datetime('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stencil_price_base_rules');
    }
}
