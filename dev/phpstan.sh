#!/bin/bash

SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )"
source "${SCRIPT_DIR}/env"

if [ "$#" -eq 0 ]; then
  set -- "app"
fi

echo "$@"
docker-compose exec $LARAVEL_CONTAINER vendor/bin/phpstan analyse "$@"
