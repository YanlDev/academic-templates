<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->decimal('price', 8, 2);

            // Archivos
            $table->string('excel_file'); // Ruta del archivo Excel
            $table->json('preview_images'); // Array de imágenes
            $table->string('main_image');

            // Contenido para la página de venta
            $table->longText('sales_content'); // HTML para página de venta
            $table->json('features'); // Lista de características
            $table->json('youtube_videos')->nullable(); // URLs de YouTube
            $table->text('concepts_explanation'); // Conceptos teóricos

            // Organización
            $table->foreignId('category_id')->constrained('template_categories');
            $table->string('difficulty')->default('intermedio');
            $table->json('tags')->nullable();

            // Métricas básicas
            $table->integer('downloads')->default(0);
            $table->decimal('rating', 3, 2)->default(0);
            $table->boolean('featured')->default(false);
            $table->boolean('active')->default(true);

            $table->timestamps();

            $table->index(['category_id', 'active']);
            $table->index(['featured', 'active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('templates');
    }
};
