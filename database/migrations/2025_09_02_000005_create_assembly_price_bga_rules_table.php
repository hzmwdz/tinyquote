<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssemblyPriceBgaRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assembly_price_bga_rules', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('min_count');
            $table->unsignedInteger('max_count');
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
        Schema::dropIfExists('assembly_price_bga_rules');
    }
}
