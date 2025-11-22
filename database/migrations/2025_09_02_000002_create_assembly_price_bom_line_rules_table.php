<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssemblyPriceBomLineRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assembly_price_bom_line_rules', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('start_lines');
            $table->unsignedDecimal('start_price', 12, 4);
            $table->unsignedInteger('step_qty');
            $table->unsignedDecimal('step_price', 12, 4);
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
        Schema::dropIfExists('assembly_price_bom_line_rules');
    }
}
