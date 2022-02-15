#!/usr/bin/env bash

VERSION=$(jq -r .version wptwig.config.json)

sed -i "s/\"version\":.*$/\"version\": \"$VERSION\",/" composer.json
sed -i "s/\"version\":.*$/\"version\": \"$VERSION\",/" package.json
sed -i "s/public const VERSION =.*$/public const VERSION = '$VERSION';/" includes/Theme.php
sed -i "s/* Version:.*$/* Version: $VERSION/" style.css
