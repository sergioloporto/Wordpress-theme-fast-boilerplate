A super fast Wordpress theme boilerplate to style to taste

## Build setup
``` bash
# clone this repository into the local theme directory
cd path/to/themes/directory
git clone https://github.com/sergioloporto/Wordpress-theme-fast-bolerplate
npm install

# update proxy server in `gulpfile.js` (line 26) to match your local domain

# launch site and watch for changes
gulp

# view all commands
gulp --tasks
```

Add vendor scripts to `gulpfile.js` (line 85), these are concatenated and output to `vendors/all.js`

GitHub Actions will run `gulp build` task to generate compressed `style.css` file at each pull request

*Note* All commands run from local node_modules directories so there should be no need to install anything globally.
