<?php

namespace App\Http\Controllers;

use App\GitHubUser;
use Illuminate\Http\Request;
use App\Providers\GitHubServiceProvider;

class GitHubUserController extends Controller
{
    public function search(string $search): string // should return JSON
    {
        return GitHubUser::search(new GitHubServiceProvider(), $search);
    }

    public function getFollowers(): string // should return JSON
    {
        $url = request('url');
        return GitHubUser::getFollowers(new GitHubServiceProvider(), $url);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GitHubUser  $gitHubUser
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        return GitHubUser::getUser(new GitHubServiceProvider(), $username);
    }

}
