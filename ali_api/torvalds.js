fetch("https://api.github.com/users/torvalds")
  .then((res) => res.json())
  .then((data) => {
    console.log(data.login);
    console.log(data.public_repos);
    console.log(data.followers);
    console.log(data.following);
  });
