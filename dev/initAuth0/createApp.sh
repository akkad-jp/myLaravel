#!/bin/bash

SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )"
PROJECT_DIR=$SCRIPT_DIR/../../
source "${PROJECT_DIR}/.env"

$SCRIPT_DIR/../auth0 apps create \
  --name "${APP_NAME}" \
  --type "regular" \
  --auth-method "post" \
  --callbacks "${APP_URL}/callback" \
  --logout-urls "${APP_URL}" \
  --reveal-secrets \
  --no-input \
  --json > $PROJECT_DIR/.auth0.app.json
