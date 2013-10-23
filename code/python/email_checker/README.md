# Email Checker Deluxe v1

This component checks the validity of the email. The check is performed
in two steps:

1. Email address is matched against an email regex;
2. The domain portion of the email address is checked for MX (mail exchange)
   record.

If both tests pass, the email is considered valid.

## Setup

First, make sure you have the prerequisite system dependencies to run
this component. They are:

* memcached
* Python 2.6 or 2.7
* Python pip, virtualenv and virtualenvwrapper

On Debian/Ubuntu systems, to install all of the above, run:

    apt-get install python-dev python-virtualenv python-pip virtualenvwrapper memcached

Then, create a Python virtual environment:

    mkvirtualenv --no-site-packages ekade
    workon ekade

Then, install the required Python packages:

    make install

## Running

To start the server (listening on all interfaces on port 8000), run:

    make server

Stop the server with Ctrl-C (SIGINT) or SIGTERM, to make it cleanly reap the
children.

## The API

To check the validity of the email, send a POST request to `/api/v1/check/`
with a single field: `email`. The response will be either 200, which indicates
a valid email, or 400, which indicates an invalid email.

Example:

    curl -F 'email=foo@bar.com' http://localhost:8000/api/v1/check/

Response:

    {"status": "valid"}

JSON requests are also valid:

    curl -H 'Content-Type: application/json' -X POST \
        -d '{"email":"foo@bar.com"}' http://localhost:8000/api/v1/check/

## Tests

The component has 100% test coverage. To run the tests, type:

    make test

To see the coverage test report, run:

    make coverage

Fancy HTML output is also available, if that wets your socks:

    coverage html

This will create a `htmlcov` directory with a bunch of HTML files. Open
`htmlcov/index.html` and be impressed.

## Local dev settings

If you want to have a different local development settings, create
a `email_checker/settings/local.py` with your settings. It will be imported
if it exists. Use the `email_checker/settings/prod.py` as a template.

## Why?

Because We Can [tm].
