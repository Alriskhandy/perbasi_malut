<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Team;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('teams', 'slug')) {
            Schema::table('teams', function (Blueprint $table) {
                $table->string('slug')->nullable()->unique()->after('name');
            });
        }

        // Backfill slugs for existing rows
        Team::all()->each(function (Team $team) {
            $base = Str::slug($team->name);
            $slug = $base;
            $i    = 1;
            while (Team::where('slug', $slug)->where('id', '!=', $team->id)->exists()) {
                $slug = $base . '-' . $i++;
            }
            $team->updateQuietly(['slug' => $slug]);
        });

    }

    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
