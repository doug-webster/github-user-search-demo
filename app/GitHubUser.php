<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Providers\GitHubServiceProvider;

class GitHubUser extends Model
{
    public static function search(GitHubServiceProvider $client, string $search): string // should return JSON
    {
        $response = $client->client->get('search/users?q=' . urlencode($search) . '+in:login');

        if ($response->getStatusCode() == 200) {
            return (string) $response->getBody(); // should be JSON
        }

        // error
        return '{}'; // return JSON representing empty object
    }

    public static function getFollowers(GitHubServiceProvider $client, string $url): string // should return JSON
    {
        $response = $client->client->get($url);

        if ($response->getStatusCode() == 200) {
            $return = array();
            $return['links'] = $response->getHeader('Link')[0] ?? '';
            $return['body'] = json_decode((string)$response->getBody(), true);
            return json_encode($return);
        }

        // error
        return '{}'; // return JSON representing empty object
    }
}
