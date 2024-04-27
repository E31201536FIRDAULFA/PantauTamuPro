<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vip', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('alamat');
            $table->string('asal_instansi');
            $table->string('no_hp');
            $table->string('keperluan');
            $table->enum('departemen', ['keuangan', 'ketenagakerjaan', 'paud/tk','sd', 'smp', 'perencanaan']);
            $table->enum('seksi', ['kurikulum/penilaian', 'sarana/prasarana', 'pendidik_sd','pendidik_smp',]);
            $table->date('tanggal');
            $table->enum('status', ['Proses', 'Approved', 'Rejected','Pending']);
            $table->string('ket');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vips');
    }
};
