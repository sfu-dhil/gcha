# Grassroots Chinese History Archive

The Grassroots Chinese History Archive (GCHA) aims to facilitate research by scholars worldwide in modern Chinese history, with a focus on the social, political, and cultural history of China's 1950s, 1960s, and 1970s.

## Requirements

- [Docker Desktop](https://www.docker.com/products/docker-desktop/)
- A copy of the `omeka.sql` database sql file. If you are not sure what these are or where to get them, you should contact the [Digital Humanities Innovation Lab](mailto:dhil@sfu.ca) for access. This file should be placed in the root folder.
- A copy of the data files. These should be placed directly into the `.data/app/files` directory (start the application for the first time if you don't see the data directory).

## Initialize the Application

First you must setup the database for the first time

    docker compose up -d db
    # wait 30 after the command has fully completed
    docker exec -it gcha_db bash -c "mysql -u gcha -ppassword gcha < /omeka.sql"

Next you must start the whole application

    docker compose up -d --build

GCHA will now be available at `http://localhost:8080/`

## General Usage

### Starting the Application

    docker compose up -d

### Stopping the Application

    docker compose down

### Rebuilding the Application (after upstream or js/php package changes)

    docker compose up -d --build

### Viewing logs (each container)

    docker logs -f gcha_app
    docker logs -f gcha_db
    docker logs -f gcha_solr
    docker logs -f gcha_mail

### Accessing the Application

    http://localhost:8080/

### Accessing Solr admin console

    http://localhost:8983/

### Accessing the Database

Command line:

    docker exec -it gcha_db mysql -u gcha -ppassword gcha

Through a database management tool:
- Host:`127.0.0.1`
- Port: `13306`
- Username: `gcha`
- Password: `password`

### Accessing Mailhog (catches emails sent by the app)

    http://localhost:8025/
