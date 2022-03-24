<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->id('billing_id');
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->string('billing_name')->comment('請求先名称');
            $table->string('billing_name_kana')->comment('請求先名称(かな)');
            $table->string('billing_address')->comment('請求先住所');
            $table->string('billing_tel')->comment('請求先電話番号');
            $table->string('department')->comment('請求先部署');
            $table->string('billing_address_name')->comment('請求先宛名');
            $table->string('billing_address_name_kana')->comment('請求先宛名(かな)');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billings');
    }
}
