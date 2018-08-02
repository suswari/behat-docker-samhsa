#!/bin/sh

# This script is for easy testing in non-Docker environments.
# Set 'DOCKER_TESTING_ENVIRONMENT: 0' in docker-compose.debug.yml.

# If else statement to set default parameters if no parameters was passed.

if [ -z "$*" ]; then
  BEHAT_PARAMETERS="--colors --format=pretty --out=std --config=behat.samhsa.yml features/tests"
else
  BEHAT_PARAMETERS="--colors --format=pretty --out=std --config=behat.samhsa.yml $*"
fi

# Run tests inside Behat container.
echo "Running tests."
docker-compose -f docker-compose.debug.yml exec behat /srv/entrypoint.sh "$BEHAT_PARAMETERS"