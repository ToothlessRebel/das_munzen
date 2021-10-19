# Das Mùnzen
Get it?

A small API and web interface for converting monetary values into coins.

# Basic Setup
1. Clone the repository:
`git clone git@github.com:ToothlessRebel/das_munzen.git path/to/local/repo`
1. `cd path/to/local/repo`
1. `composer setup`

## Usage via the browser
This project provides a basic, locally hosted demo. The actual port of the server may vary based on the 
environment but by default the link included below will work. See output and `./artisan help serve` for
any issues.

1. `cd /path/to/local/repo`
2. `./artisan serve`
3. Visit URI given in the command output (Example: `Starting Laravel development server: http://127.0.0.1:8000`).

## Usage via the command line.
In addition to web based use this project provides a command line interface to provide the functionality of
API.

See `./artisan help convert` for full usage details.

1. `cd /path/to/local/repo`
2. `./artisan convert [amount]`

# Contributing
[Pull requests](https://github.com/ToothlessRebel/das_munzen/pulls) are welcome.

Make sure tests pass before submitting by running `./artisan test`.

# FAQ

### What if I don't have Composer installed?
See [the Composer documentation](https://getcomposer.org/doc/00-intro.md).

### What if I don't have npm installed?
See [the NPM documentation](https://docs.npmjs.com/downloading-and-installing-node-js-and-npm). Though
if on OSX using [Homebrew](https://brew.sh/) is recommended.

### What currencies are supported?
This is a demo. If you decide to pay me I'll add all sorts of currencies for you.

Right now, only USD is supported.

### How do I report a bug?
Submit an issue on [Github](https://github.com/ToothlessRebel/das_munzen/issues/new)!
