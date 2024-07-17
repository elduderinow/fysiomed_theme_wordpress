![](https://viavictor.com/logos/Viavictor_Logo_Logo_Zwart.png)

------------
# Wordpress Starter Theme

This is a starter project to create a new Wordpress theme using Timber, Gulp, Webpack.

## Setup

1. execute `cd theme`
2. execute `nvm use`
3. `npm install`
4. change config in `src/scss/style.scss`
5. change `<theme-name>` in `gulp/config.js`
6. You should be all set!

### Using Gulp

If you run `npm run start` the project should launch on localhost:3000.
`npm build` makes a compiled copy of the theme in your theme folder.

### How It Works

You can set a proxy url in de gulp/config.js within the Browsersync task so localhost will display your theme plus the wordpress set-up.
BrowserSync reloads your browser every time when changes have been made.

### Getting The Theme Working with Wordpress

We've got the theme building, but because it's not pure Wordpress/PHP we need to install a plugin before we activate the theme:

* Navigate to `localhost:3000/wp-admin` and login with your wordpress account
* `Plugins > Timber`. Hit `Activate`
* Then activate the theme: `Appearance > My Theme`

[Timber Docs](https://timber.github.io/docs/)

[Twig Docs](https://twig.symfony.com/doc/2.x/)

## Development

1. `yarn start` or `npm run start`
1. 💸 money 💸

## Production

1. `npm run build`
1. 💸 money 💸
