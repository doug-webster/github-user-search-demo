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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GitHubUser  $gitHubUser
     * @return \Illuminate\Http\Response
     */
    public function show(GitHubUser $gitHubUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GitHubUser  $gitHubUser
     * @return \Illuminate\Http\Response
     */
    public function edit(GitHubUser $gitHubUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GitHubUser  $gitHubUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GitHubUser $gitHubUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GitHubUser  $gitHubUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(GitHubUser $gitHubUser)
    {
        //
    }
}
