<?php


namespace Evryn\LaravelToman\Tests;


final class LaravelTomanServiceProviderTest extends TestCase
{
    /** @test */
    public function publishes_config_correctly()
    {
        $source = __DIR__ . '/../config/toman.php';
        $dest = config_path('toman.php');

        $this->assertTrue(unlink($dest));

        $this->artisan('vendor:publish', [
            '--provider' => 'Evryn\LaravelToman\LaravelTomanServiceProvider',
            '--tag' => 'config'
        ]);

        $this->assertFileExists($dest);
        $this->assertFileIsReadable($dest);
        $this->assertFileEquals($dest, $source);
    }

    /** @test */
    public function publishes_translations_correctly()
    {
        $map = [
            __DIR__ . '/../resources/lang/en/zarinpal.php' => resource_path('lang/vendor/toman/en/zarinpal.php'),
            __DIR__ . '/../resources/lang/fa/zarinpal.php' => resource_path('lang/vendor/toman/fa/zarinpal.php'),
        ];

        foreach (array_values($map) as $dest) {
            $this->assertTrue(unlink($dest));
        }

        $this->artisan('vendor:publish', [
            '--provider' => 'Evryn\LaravelToman\LaravelTomanServiceProvider',
            '--tag' => 'lang'
        ]);

        foreach ($map as $source => $dest) {
            $this->assertFileExists($dest);
            $this->assertFileIsReadable($dest);
            $this->assertFileEquals($dest, $source);
        }
    }
}
