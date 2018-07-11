#!/bin/sh

# This script is for easy testing in non-Docker environments.
# Set 'DOCKER_TESTING_ENVIRONMENT: 0' in docker-compose.all-tests.yml.

# If else statement to set default parameters if no parameters was passed.

if [ -z "$*" ]; then
  BEHAT_PARAMETERS="--colors --format=pretty --out=std --config=behat.samhsa.yml features/tests"
else
  BEHAT_PARAMETERS="--colors --format=pretty --out=std --config=behat.samhsa.yml $*"
fi

# Start Behat and Selenium server containers
docker-compose -f docker-compose.all-tests.yml up -d

# Additional time for Selenium.
echo 'Sleeping while selenium and behat containers are being built.'
echo '...'
echo 'TIP: If you get strange errors, try increasing the sleep time'
sleep 3

echo "Copying your desired yaml to the root directory. It's a behat thing."
echo '...'
docker-compose -f docker-compose.all-tests.yml exec behat cp ./project-yamls/*.yml /srv
# docker-compose -f docker-compose.all-tests.yml exec behat /drupal/smokefree composer install
echo "Running composer update"
docker-compose -f docker-compose.all-tests.yml exec behat composer update

# Run tests inside Behat container.
echo "Running tests."
# docker-compose -f docker-compose.all-tests.yml exec behat bin/behat "$BEHAT_PARAMETERS"
docker-compose -f docker-compose.all-tests.yml exec behat /srv/entrypoint.sh "$BEHAT_PARAMETERS"

## Stop and remove containers.
#docker-compose -f docker-compose.all-tests.yml down
