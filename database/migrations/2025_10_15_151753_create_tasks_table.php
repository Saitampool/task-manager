<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('tasks', function (Blueprint $table) {
      $table->id('task_id');
      $table->unsignedBigInteger('user_id');
      $table->string('title');
      $table->text('description')->nullable();
      $table->enum('status', ['To Do', 'In Progress', 'Done'])->default('To Do');
      $table->date('deadline')->nullable();
      $table->string('created_by')->nullable();
      $table->timestamps();

      // Foreign key
      $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('tasks');
  }
};
