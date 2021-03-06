#!/bin/sh

# This script is for easy testing in non-Docker environments.
# Set 'DOCKER_TESTING_ENVIRONMENT: 0' in docker-compose.all-tests.yml.

# If else statement to set default parameters if no parameters was passed.

if [ -z "$*" ]; then
  BEHAT_PARAMETERS="--colors --format=pretty -f cucumber_json --out=std --config=behat.samhsa.yml features/tests"
else
  BEHAT_PARAMETERS="--colors --format=pretty -f cucumber_json --out=std --config=behat.samhsa.yml $*"
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
#echo "Running composer update"
#docker-compose -f docker-compose.all-tests.yml exec behat composer update

# Run tests inside Behat container.
echo "Running tests..."
docker-compose -f docker-compose.all-tests.yml exec behat /srv/entrypoint.sh "$BEHAT_PARAMETERS"

echo "Generating reports..."
cp ./artifacts/report.json ./Jenkins/workspace/CucumberReport/
JENKINS_BUILD_NUMBER=$(cat ./Jenkins/jobs/CucumberReport/nextBuildNumber)
#echo $JENKINS_BUILD_NUMBER
CRUMB=$(curl -s 'http://admin:admin@localhost:8686/crumbIssuer/api/xml?xpath=concat(//crumbRequestField,":",//crumb)')
curl -X POST -H "$CRUMB" -u admin:admin http://localhost:8686/job/CucumberReport/build
sleep 8
cp -r ./Jenkins/jobs/CucumberReport/builds/$JENKINS_BUILD_NUMBER/cucumber-html-reports ./reports
SEND_TO_SLACK=false
if [ "$SEND_TO_SLACK" = true ] ; then
    sh send_to_slack.sh
fi