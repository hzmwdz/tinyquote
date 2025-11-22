<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePcbPriceBoardRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pcb_price_board_rules', function (Blueprint $table) {
            $table->id();
            $table->string('material');
            $table->unsignedInteger('layers');
            $table->unsignedDecimal('min_area_m2', 12, 4);
            $table->unsignedDecimal('max_area_m2', 12, 4);
            $table->unsignedInteger('leadtime_hours');
            $table->unsignedDecimal('price', 12, 4)->nullable();
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
        Schema::dropIfExists('pcb_price_board_rules');
    }
}
