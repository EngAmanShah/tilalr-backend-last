<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Fetch and group current city records
        $oldCities = [];
        if (Schema::hasTable('cities')) {
            $oldCities = DB::table('cities')->get();
        }

        // Group by slug
        $grouped = [];
        foreach ($oldCities as $c) {
            $slug = $c->slug;
            if (!isset($grouped[$slug])) {
                $grouped[$slug] = [
                    'slug' => $slug,
                    'names' => [],
                    'descriptions' => [],
                    'best_times' => [],
                    'activities' => [],
                    'landmarks' => [],
                    'image' => $c->image,
                    'images' => $c->images,
                    'country' => $c->country ?? 'Saudi Arabia',
                    'order' => $c->order ?? 0,
                    'is_active' => $c->is_active ?? 1,
                    'created_at' => $c->created_at,
                    'updated_at' => $c->updated_at,
                ];
            }
            $lang = $c->lang ?? 'ar';
            $grouped[$slug]['names'][$lang] = $c->name;
            $grouped[$slug]['descriptions'][$lang] = $c->description;
            $grouped[$slug]['best_times'][$lang] = $c->best_time ?? '';
            
            // Decoded arrays
            $acts = json_decode($c->activities ?? '[]', true);
            $grouped[$slug]['activities'][$lang] = is_array($acts) ? $acts : [];
            
            $lands = json_decode($c->landmarks ?? '[]', true);
            $grouped[$slug]['landmarks'][$lang] = is_array($lands) ? $lands : [];

            // Prefer populated fields
            if (!empty($c->image)) {
                $grouped[$slug]['image'] = $c->image;
            }
            if (!empty($c->images) && $c->images !== '[]') {
                $grouped[$slug]['images'] = $c->images;
            }
        }

        // 2. Re-create the table
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('cities');

        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->json('name'); // Spatie Translatable stores JSON
            $table->string('slug')->unique();
            $table->json('description')->nullable();
            $table->string('image')->nullable();
            $table->json('images')->nullable();
            $table->string('country')->default('Saudi Arabia');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->json('best_time')->nullable();
            $table->json('activities')->nullable();
            $table->json('landmarks')->nullable();
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();

        // 3. Insert combined translatable records
        foreach ($grouped as $slug => $data) {
            DB::table('cities')->insert([
                'slug' => $slug,
                'name' => json_encode($data['names']),
                'description' => json_encode($data['descriptions']),
                'best_time' => json_encode($data['best_times']),
                'activities' => json_encode($data['activities']),
                'landmarks' => json_encode($data['landmarks']),
                'image' => $data['image'],
                'images' => $data['images'],
                'country' => $data['country'],
                'order' => $data['order'],
                'is_active' => $data['is_active'],
                'created_at' => $data['created_at'] ?? now(),
                'updated_at' => $data['updated_at'] ?? now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. Fetch current Spatie translatable records
        $cities = DB::table('cities')->get();

        // 2. Drop and recreate the old table structure
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('cities');

        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->json('images')->nullable();
            $table->string('country')->default('Saudi Arabia');
            $table->integer('order')->default(0);
            $table->string('lang', 10)->default('ar');
            $table->boolean('is_active')->default(true);
            $table->string('best_time')->nullable();
            $table->json('activities')->nullable();
            $table->json('landmarks')->nullable();
            $table->timestamps();

            $table->unique(['slug', 'lang']);
        });
        Schema::enableForeignKeyConstraints();

        // 3. De-serialize and write back as separate rows
        foreach ($cities as $c) {
            $names = json_decode($c->name ?? '[]', true) ?: [];
            $descriptions = json_decode($c->description ?? '[]', true) ?: [];
            $bestTimes = json_decode($c->best_time ?? '[]', true) ?: [];
            $activities = json_decode($c->activities ?? '[]', true) ?: [];
            $landmarks = json_decode($c->landmarks ?? '[]', true) ?: [];

            $locales = array_unique(array_merge(
                array_keys($names),
                array_keys($descriptions),
                array_keys($bestTimes),
                array_keys($activities),
                array_keys($landmarks)
            ));

            if (empty($locales)) {
                $locales = ['ar', 'en'];
            }

            foreach ($locales as $lang) {
                DB::table('cities')->insert([
                    'name' => $names[$lang] ?? ($names['ar'] ?? ($names['en'] ?? '')),
                    'slug' => $c->slug,
                    'description' => $descriptions[$lang] ?? ($descriptions['ar'] ?? ($descriptions['en'] ?? null)),
                    'best_time' => $bestTimes[$lang] ?? ($bestTimes['ar'] ?? ($bestTimes['en'] ?? null)),
                    'activities' => json_encode($activities[$lang] ?? []),
                    'landmarks' => json_encode($landmarks[$lang] ?? []),
                    'image' => $c->image,
                    'images' => $c->images,
                    'country' => $c->country,
                    'order' => $c->order,
                    'lang' => $lang,
                    'is_active' => $c->is_active,
                    'created_at' => $c->created_at,
                    'updated_at' => $c->updated_at,
                ]);
            }
        }
    }
};
