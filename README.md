# Laravel Blog

A personal blog built with Laravel 12 and PostgreSQL. Users can register, write posts with cover images, filter posts by topic and leave comments. The interface is in Uzbek.

## Features

- **Posts:** create, edit and delete posts with a title, summary, topic, body and an optional image (jpg/png, up to 2 MB)
- **Topics:** filter the post list by topic (Laravel, PHP, MySQL, Docker, Git, Boshqa)
- **Comments:** logged-in users can comment on any post
- **Authentication:** register, log in with "remember me", log out
- **Authorization:** only the author of a post can edit or delete it (`PostPolicy`)
- **Rate limiting:** login is limited to 5 attempts per minute per email and 10 per IP; registration to 3 per minute per IP
- **Events:** creating a post fires a `PostCreated` event, handled by the `SendEmailToUser` and `SendNotificationToAdmin` listeners

## Tech stack

- PHP 8.5, Laravel 12
- PostgreSQL 18
- Blade templates, Vite, Tailwind CSS 4
- Docker via [Laravel Sail](https://laravel.com/docs/sail)

## Getting started

You need Docker. You don't need PHP, Composer or Node installed locally; everything runs in containers.

```bash
git clone https://github.com/khvrshdvc/laravel-blog.git
cd laravel-blog

# Install PHP dependencies (uses a throwaway Composer container)
docker run --rm -u "$(id -u):$(id -g)" -v "$(pwd):/var/www/html" -w /var/www/html \
    laravelsail/php84-composer:latest composer install --ignore-platform-reqs

# Create your env file, then set DB_PASSWORD in it
cp .env.example .env

# Start the app and database
./vendor/bin/sail up -d

# Finish setup
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate --seed
./vendor/bin/sail artisan storage:link
./vendor/bin/sail npm install
./vendor/bin/sail npm run build
```

Open **http://localhost:8080**.

The seeder creates sample users, posts and comments. Every seeded user's password is `password`.

### Ports

| Service | Default port | `.env` variable |
| --- | --- | --- |
| App | 8080 | `APP_PORT` |
| Vite dev server | 5174 | `VITE_PORT` |
| PostgreSQL | 5432 | `FORWARD_DB_PORT` |

Change these in `.env` if they clash with other projects, then run `sail up -d` again.

## Everyday commands

Tip: add `alias sail='./vendor/bin/sail'` to your shell config.

```bash
sail up -d                       # start
sail stop                        # stop
sail npm run dev                 # live-reload CSS/JS while editing
sail artisan migrate:fresh --seed  # reset the database with sample data
sail artisan test                # run the test suite
```

## Tests

Feature tests cover authentication, posts and comments (`tests/Feature`). They run against a separate `testing` database that the Sail Postgres container creates on first start, so your local data isn't touched.

```bash
sail artisan test
```

## Project structure

```
app/
├── Events/PostCreated.php
├── Http/
│   ├── Controllers/   AuthController, PostController, CommentController, PageController
│   └── Requests/      LoginRequest, RegisterRequest, StorePostRequest
├── Listeners/         SendEmailToUser, SendNotificationToAdmin
├── Models/            User, Post, Comment
├── Policies/PostPolicy.php
└── Providers/AppServiceProvider.php   (rate limiters)
resources/views/       Blade views (auth, posts, components)
routes/web.php         all routes
tests/Feature/         AuthTest, PostTest, CommentTest
```

## Routes

| Method | URL | Access | Description |
| --- | --- | --- | --- |
| GET | `/` | public | Home page |
| GET | `/contact` | public | Contact page |
| GET | `/posts` | public | Post list (`?tag=` filters by topic) |
| GET | `/posts/{post}` | public | Single post with comments |
| GET / POST | `/login`, `/authenticate` | guests | Log in |
| GET / POST | `/register` | guests | Register |
| POST | `/logout` | logged in | Log out |
| GET / POST | `/posts/create`, `/posts` | logged in | Create a post |
| GET / PUT | `/posts/{post}/edit`, `/posts/{post}` | author | Edit a post |
| DELETE | `/posts/{post}` | author | Delete a post |
| POST | `/comments` | logged in | Add a comment |

## Author

Utkirbek ([@khvrshdvc](https://github.com/khvrshdvc))
