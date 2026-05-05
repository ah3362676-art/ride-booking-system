<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * تشغيل Seeder الأساسي
     */
    public function run(): void
    {
        // إنشاء أدمن افتراضي
        User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'phone' => '01000000001',
        ]);

        // إنشاء سائق تجريبي
        User::factory()->driver()->create([
            'name' => 'Driver User',
            'email' => 'driver@example.com',
            'phone' => '01000000002',
        ]);

        // إنشاء راكب تجريبي
        User::factory()->rider()->create([
            'name' => 'Rider User',
            'email' => 'rider@example.com',
            'phone' => '01000000003',
        ]);
    }
}
