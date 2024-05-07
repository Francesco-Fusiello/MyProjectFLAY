<?php


use App\Models\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable;
            $table->timestamps();
        });

        $categories =['Abbigliamento','Informatica','Elettrodomestici','Libri','Giochi','Sport','Telefonia','Servizi','Arredamento','Videogames','AccessoriPerAnimali','Televisori'];
        $images =['\images\Category\abbigliamento1 (5).png','\images\Category\ImmagineInformatica (6).png','\images\Category\ImmagineElettrodomestici (9).png','\images\Category\ImmagineLibri (2).png','\images\Category\ImmagineGiochi(2).png','\images\Category\ImmagineSport (6).png','\images\Category\ImmagineTelefoni (4).png','\images\Category\ImmagineServizi.png','\images\Category\ImmagineArredamento (4).png','\images\Category\ImmagineVideoGames (3).png','\images\Category\ImmagineAccPerAnimali (5).png','\images\Category\ImmagineTelevisori (4).png'];
        foreach ($categories as $index => $category) {
            Category::create([
                'name' => $category,
                'image' => $images[$index] // Usiamo l'indice per ottenere l'immagine corrispondente
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
