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
                    Schema::create('documents', function (Blueprint $table) {
                        $table->id();
                        $table->string('name');
                        $table->string('nama_dokumen');
                        $table->string('nomor_dokumen');
                        $table->string('deskripsi')->nullable();
                        $table->string('directory')->nullable();
                        $table->string('give_access_to');
                        $table->string('give_edit_access_to')->nullable();
                        $table->unsignedBigInteger('created_by');
                        $table->foreign('created_by')->references('id')->on('users');
                        $table->string('menggantikan_dokumen')->nullable();
                        $table->string('parent')->nullable();
                        $table->integer('year');
                        $table->string('tipe_dokumen');
                        $table->timestamp('start_date');
                        $table->timestamp('end_date')->nullable();
                        $table->boolean('keterangan_status')->default(true);
                        $table->boolean('can_see_by')->default(true);
                        $table->string('link')->nullable();
                        $table->boolean('keterangan_berlaku')->nullable();
                        $table->timestamps();

                    });
                }

                /**
                 * Reverse the migrations.
                 */
                public function down(): void
                {
                    Schema::dropIfExists('documents');
                }
            };
