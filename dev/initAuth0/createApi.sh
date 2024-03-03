#!/bin/bash

SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )"
PROJECT_DIR=$SCRIPT_DIR/../../
source "${PROJECT_DIR}/.env"

$SCRIPT_DIR/../auth0 apis create \
  --name "${APP_NAME} API" \
  --identifier "https://github.com/auth0/laravel-auth0" \
  --offline-access \
  --no-input \
  --json > $PROJECT_DIR/.auth0.api.json
