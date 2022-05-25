# ddev-docker-selenium

## About

This project will start a ddev project running a dockerized selenium grid.

The grid is based on https://github.com/SeleniumHQ/docker-selenium with some adoptions for running inside and
testing of other ddev projects. To also support the ARM architecture docker images are used from
https://github.com/seleniumhq-community/docker-seleniarm.

The browser containers contain noVNC, which allows to watch the test browsers from inside the browser. 

## Important: Add .ddev/docker-compose.external_links.yaml

To test other ddev projects you need to create the file .ddev/docker-compose.external_links.yaml and make sure the
other projects local DNS names are routed over the ddev-router.

E.g. if your other project uses mysite.ddev.site as local name, create the file .ddev/docker-compose.external_links.yaml
with the following content:

```yaml
services:
  chrome:
    external_links:
      - "ddev-router:mysite.ddev.site"
  firefox:
    external_links:
      - "ddev-router:mysite.ddev.site"
```

## Start the project

Start the ddev-docker-selenium project like any other ddev project from inside the project folder:

```shell
ddev start
```

You should now be able to see an overview page by visiting https://selenium.ddev.site/index.php

## Codeception config for using the ddev-docker-selenium in other projects

The selenium hub will be available as *ddev-selenium-hub* on port 4444 in other ddev projects.
So use a selenium config (e.g. in acceptance.suite.yml) which contains a WebDriver config like:

```yaml
actor: AcceptanceTester
modules:
  enabled:
    - WebDriver
    - Asserts
  config:
    WebDriver :
      host: ddev-selenium-hub
      url: https://mysite.ddev.site
      browser: chrome
      port: 4444
      window_size: false
      capabilities:
        acceptInsecureCerts: true
        "goog:chromeOptions":
          args : [ "--no-sandbox", "--disable-gpu", "allow-insecure-localhost", "--ignore-certificate-errors" ]
```

For testing we allow insecure (self-signed) SSL certificates here for chrome and firefox.

## Watch tests live in the test browsers

To watch the tests running in the test browsers use the following URLs:

- Chrome: http://selenium.ddev.site:7900/
- Firefox: http://selenium.ddev.site:7901/

and click the "Connect" button in the noVNC screen. No password is needed.






