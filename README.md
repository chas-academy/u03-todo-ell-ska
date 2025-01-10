# Ordna

This is my U03 assignment for the backend course at Chas Academy. Ordna is a task management app designed to help you track and organize your tasks efficiently. There are both custom and smart lists to categorize your tasks. Each task includes detailed information such as a deadline, a scheduled date, and notes. The app also supports user authentication with a username and password to keep your data secure.

![screenshot](/assets/screenshot.png)

## Table of contents

- [Getting started](#getting-started)
- [Resources](#resources)
- [Project structure](#project-structure)

## Getting started

First, build and run the docker container:

```bash
docker compose up
```

This will start three services:

- The PHP server, available at [http://localhost/](http://localhost/)
- The MariaDB database
- Adminer, available at [http://localhost:8080/](http://localhost:8080/)
  - Credentials for logging in can be found in [docker-compose.yml](/docker-compose.yml)

The first time you build the container the database structure will be set up according to [seed.sql](/entrypoint/seed.sql).

Once the docker container is up and running you can run PHP_CodeSniffer to check the code against the PSR-12 standard with:

```bash
docker compose exec php phpcs --ignore=/vendor --extensions=php /var/www/html/
```

## Resources

[Entity relationship diagram](https://drawsql.app/teams/ellska/diagrams/todo)

![Entity relationship diagram](/assets/erd.png)

[Figma](https://www.figma.com/design/o62OpFhDZU5SjoEIj7BQJY/todo?node-id=16-352&t=XBRgp0PwuX3jcVxL-1)

![Figma](/assets/figma.png)

## Project structure

The project is organized into the following directories:

### /

All routes, like `index.php` and `today.php` are kept at the root of the `/src` directory. Here you can also find the `Database` class used to get the singleton instance of the connection connecting the project to the MariaDB database. There is also a file called `layout.php` that is responsible for providing a base template to all routes.

### /actions

Handles mutations like creating and managing tasks and lists. Each file represents a resource that decides what type of CRUD action is to be used.

### /components

Contains reusable templates and class components for modularity and reusability. Most components consist of a `component.php` and a `component.template.php`. The first file is responsible for handling props and data, while the template is responsible for handling markup. All components have a `render` function that is used any time you want to display the component.

```php
Component::render($props);
```

### /lib

Contains libraries essential for the core functionality of the app. These files include reusable code, such as authentication logic, that can be used across different parts of the application.

### /scripts

This project is mostly built with PHP but there are some small user experience parts that are built with JavaScript. This directory includes logic for opening and closing modals, input field previews and more...

### /styles

The project is styled with SCSS to create reusable and well structured styling. This directory consists of partial SCSS files that are being pulled in to [style.scss](/src/styles/style.scss) and compiled to CSS.

### /utils

Includes helper functions for things such as date formatting, input validating and navigation, to simplify the main application logic.
