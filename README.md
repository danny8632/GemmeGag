<p align="center">
  <h1 align="center">GemmeGag</h1>

  <p align="center">GemmeGag is a social media platform for viewing and sharing memes</p>
</p>

## Index

* [About the Project](#about-the-project)
* [Features](#features)
* [Technologies](#technologies)
* [Installation](#installation)
    * [Usage](#usage)


## About The Project

GemmeGag is a social media platform, based around the same ideas as sites such as 9Gag and Reddit. So the main reason this platform needs to exist is for spreading joy and happiness to people, through the beautiful thing we gamers call memes.
Our site aims to have a wide collection of categories, all filled with the latest trends of memes of all shapes and sizes.

The site was created with users in mind, which means the power belongs to them! All of the posts you see on the frontpage is what a majority of our users are either upvoting or commenting on. When our users determine what goes and what doesn’t, we end up with a site that does NOT:
Disguises ads as posts
Post spam
Post hate-speech/other hateful content

The site is going to be packed with a lot of features. Our goal is to make every feature easy to use, to give the users the best experience when browsing or sharing memes.
Many of the features will be listed in the feature section.



## Features:

- Frontpage displaying trendings posts
- Register/login user
- All posts can be upvoted/downvoted
- All posts can be clicked and commented on
- All comments can be up/downvoted
- Every user can submit posts after completing registration and logging in
- Whenever a post is clicked, you'll be able to see the original poster og click his name.
    - This will display all of the posts submitted by that user.



## Technologies:

We are going to use docker for our dev-env.

We are using these technologies:
- [PHP](https://www.php.net)
- [Bootstrap](https://getbootstrap.com)
- [JQuery](https://jquery.com)
- [HTML5](https://en.wikipedia.org/wiki/HTML5)
- [CSS](https://en.wikipedia.org/wiki/Cascading_Style_Sheets)
- [MySQL/MariaDB](https://www.mysql.com)
- [Docker](https://www.docker.com)


## Installation

1. Be sure that [Docker](https://www.docker.com) and [Docker-Compose](https://docs.docker.com/compose) are installed.
2. Clone the repo
```sh
git clone https://github.com/danny8632/GemmeGag.git
```
3. Checkout the "docker" branch
```sh
git checkout docker
```
4. Pull from git
```sh
git pull
```

## Usage

If everything is installed probably as shown in the [installation guide](#installation) you should be able to run:
```sh
docker-compose up -d
```

To turn of the docker env, run:
```sh
docker-compose down
```

## Troubleshooting

1. If you have problem with running docker-compose you may need to build it first, by running:
```sh
docker-compose build
```

2. If you have trouble with importing the data-base through phpMyAdmin you can try this command:
```sh
docker exec -i gemmegag_db_1 sh -c 'exec mysql -uroot -p"ROOT-Password"' < /path/to/sql/file
```
