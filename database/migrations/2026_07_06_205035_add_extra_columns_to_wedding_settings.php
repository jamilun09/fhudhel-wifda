<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('wedding_settings', function (Blueprint $table) {
            $table->string('bride_parents')->default('Bapak & Ibu Mempelai Wanita')->after('bride_name');
            $table->string('groom_parents')->default('Bapak & Ibu Mempelai Pria')->after('groom_name');
            $table->string('theme_bg_color')->default('#FBF6EC')->after('id'); // Default Ivory
            $table->string('theme_text_color')->default('#1E1C1A')->after('theme_bg_color'); // Default Charcoal
            $table->text('love_story')->nullable()->after('welcome_quote');
        });
    }

    public function down(): void
    {
        Schema::table('wedding_settings', function (Blueprint $table) {
            $table->dropColumn(['bride_parents', 'groom_parents', 'theme_bg_color', 'theme_text_color', 'love_story']);
        });
    }
};
