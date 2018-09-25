<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class GitHubServiceProvider extends ServiceProvider
{
	protected $defer = true;
	protected $client;

    public function __construct()
    {
        $this->client = new Client([
			'base_uri' => 'https://api.github.com/'
		]);
    }
    
    public function __get($property)
    {
        if ($property == 'client')
            return $this->client;
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
