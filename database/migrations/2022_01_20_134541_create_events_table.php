<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('event_category_id');
            $table->uuid('event_format_id');
            $table->string('name');
            $table->string('description');
            $table->string('geopoint')->nullable();
            $table->text('geopoint_address')->nullable();
            $table->string('online_url');
            $table->timestamp('started_at');
            $table->timestamp('ended_at');
            $table->text('logo_path')->nullable();
            $table->text('landing_page_url')->nullable();
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->uuid('deleted_by')->nullable();
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
        Schema::dropIfExists('events');
    }
}
