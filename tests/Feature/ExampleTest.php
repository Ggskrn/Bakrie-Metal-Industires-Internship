<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $routes = [
            '/',
            '/tentang',
            '/berita',
            '/kontak',
            '/proyek',
            '/produk',
            '/produk/sembako',
            '/produk/logistik',
            '/produk/agrobisnis',
            '/layanan',
            '/layanan/simpan-pinjam',
            '/layanan/kemitraan',
            '/layanan/konsultasi',
            '/layanan/pelayanan-anggota',
            '/layanan/pemasaran',
            '/layanan/pelatihan',
        ];

        foreach ($routes as $route) {
            $response = $this->get($route);
            if ($route === '/produk') {
                $response->assertStatus(302);
            } else {
                $response->assertStatus(200);
            }
        }
    }
}
