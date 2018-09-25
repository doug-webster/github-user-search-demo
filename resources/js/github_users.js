var parse = require('parse-link-header');

// bind event handler
$('#search-github-users').click(function(e){
    e.preventDefault();
    let username = $('#i-username').val();
    getGitHubUser(username);
});

// retrieve user info from API
function getGitHubUser(username) {
    // clear any previous results
    $('#results').html('');

    if (username == '')
        return;

    axios.get(`/users/${username}`)
    .then(function (response) {
        let user = response.data;
        if (user)
            showUser(user);
        else {
            $('#results').html('<p>User not found; please try another search.</p>');
        }
    })
    .catch(function (error) {
        console.log(error);
    });
}

// use API to search for users
function searchGitHubUsers(search) {
    // clear any previous results
    $('#results').html('');
    
    if (search == '')
        return;

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

// update the search
function updateSearch(el) {
    let username = el.textContent;
    // prevent update if already selected
    if ($('#i-username').val() == username)
        return;
    $('#i-username').val(username);
    searchGitHubUsers(username);
}

// output a list of users
function listUsers(users) {
    for (let user of users) {
        $('#results').append(`
        <div>
            <a href='javascript:void(0)'>${user.login}</a>
        </div>
        `);
        $('a').click(function(e){
            e.preventDefault();
            e.stopPropagation();
            updateSearch(e.currentTarget);
        });
    }
}

// show the specified user
function showUser(user) {
    console.log
    $('#results').html(`<h3>${user.login}</h3>
    <h4>Followers (${user.followers}):</h4>`);
    getFollowers(user.followers_url, listFollowers);
}

// get follower info from API
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

// output followers
function listFollowers(followers, links = {}) {
    // only add the following if we're on the first page
    if (! (links && links.prev))
        $('#results').append(`<div class="followers row"></div>`);

    if (followers.length < 1) {
        $('#results .followers').html(`No followers.`);
        return;
    }

    for (let follower of followers) {
        $('#results .followers').append(`<a href="${follower.html_url}" class="col">
            <img src="${follower.avatar_url}" alt="${follower.login}" title="${follower.login}" />
        </a>`);
    }

    // include load more button and handler
    if (links && links.next) {
        $('#load-more').remove();
        $('#results').append(`
            <button type="button" class="btn btn-default" id="load-more">Load More</button>
        `);
        $('#load-more').click(function(){
            getFollowers(links.next.url, listFollowers);
        });
    }
}
