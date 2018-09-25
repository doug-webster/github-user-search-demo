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
            $return['links'] = $response->getHeader('Link')[0];
            // Link: <https://api.github.com/user/463230/followers?page=2>; rel="next", <https://api.github.com/user/463230/followers?page=446>; rel="last"
            // $headers = '';
            // foreach ($response->getHeaders() as $name => $values) {
            //     $headers .= "$name: " . implode(', ', $values) . "\n";
            // }
            $return['body'] = json_decode((string)$response->getBody(), true);
            return json_encode($return);
            // $a = apache_request_headers();
            // $b = apache_response_headers();
            // $response = json_decode($response);
            // $response = "\$response = ".var_export($response, true)."\n";
            // $response .= "apache_request_headers() = ".var_export($a, true)."\n";
            // $response .= "apache_response_headers() = ".var_export($b, true)."\n";
            // $output = "headers = ".var_export($headers, true)."\n";
            // $output .= "body = ".var_export($body, true)."\n";
            // return (string) $response->getBody(); // should be JSON
        }

        // error
        return '{}'; // return JSON representing empty object
    }
}
