var parse = require('parse-link-header');

$('#search-github-users').click(function(e){
    e.preventDefault();
    let search = $('#i-username').val();
    searchGitHubUsers(search);
});

function searchGitHubUsers(search) {
    // clear any previous results
    $('#results').html('');

    axios.get(`/search/users/${search}`)
    .then(function (response) {
        let users = response.data.items;
        if (users.length > 1) {
            let i = users.findIndex((user) => user.login == search);
            if (i != -1)
                return showUser(users[i]);
            listUsers(users);
        } else if (users.length == 1)
            showUser(users[0]);
        else {
            $('#results').html('<p>No matches; please try another search.</p>');
        }
    })
    .catch(function (error) {
        console.log(error);
    });
}

function updateSearch(el) {
    let username = $(el).text();
    $('#i-username').val(username);
    searchGitHubUsers(username);
}

function listUsers(users) {
    for (let user of users) {
        $('#results').append(`
        <div>
            <a href='javascript:void(0)' onclick="updateSearch(this);">${user.login}</a>
        </div>
        `);
    }
}

function showUser(user) {
    $('#results').html(`<h3>${user.login}</h3>`);
    getFollowers(user.followers_url, listFollowers);
}

function getFollowers(url, callback) {
    axios.get(`/users/followers`, {params: {url: url}})
    .then(function (response) {
        let links = parse(response.data.links);
        let followers = response.data.body;
        if (typeof callback == 'function')
            callback(followers, links);
    })
    .catch(function (error) {
        console.log(error);
    });
}

function listFollowers(followers, links = {}) {
    // only add the following if we're on the first page
    if (! links.prev)
        $('#results').append(`<h4>Followers:</h4>
        <div class="followers row"></div>`);

    if (followers.length < 1) {
        $('#results .followers').html(`No followers.`);
        return;
    }

    for (let follower of followers) {
        $('#results .followers').append(`<a href="${follower.html_url}" class="col">
            <img src="${follower.avatar_url}" alt="${follower.login}" title="${follower.login}" />
        </a>`);
    }

    if (links.next) {
        $('#load-more').remove();
        $('#results').append(`
            <button type="button" class="btn btn-default" id="load-more">Load More</button>
        `);
        $('#load-more').click(function(){
            getFollowers(links.next.url, listFollowers);
        });
    }
}
