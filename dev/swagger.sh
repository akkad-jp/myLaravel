#!/bin/bash

SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )"
source "${SCRIPT_DIR}/env"

CMD="php artisan l5-swagger:generate"
docker-compose exec $LARAVEL_CONTAINER $CMD
