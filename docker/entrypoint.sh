#!/bin/sh

# To run tests you need to pass some parameters to Behat container.
# E.x., docker-compose exec behat /srv/entrypoint.sh "--format=pretty --out=std".

# Section to keep container working in detached mode.
# cp /srv/project-yamls/*.yml /srv/
if [ -z "$*" ]; then
  # Run Behat with parameters passed as command.
  bin/behat $*
  # Fix permissions to artifacts folder.
  chmod -R 777 /srv/artifacts

fi
