<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->comment('会社名');
            $table->string('company_name_kana')->comment('会社名(かな)');
            $table->string('address')->comment('住所');
            $table->string('tel')->comment('電話番号');
            $table->string('representative')->comment('代表名');
            $table->string('representative_kana')->comment('代表名(かな)');
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
        Schema::dropIfExists('companies');
    }
}
