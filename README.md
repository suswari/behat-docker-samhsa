# behat-primer

## Setup
### Prerequisites
Docker
### Projects-yamls
Make a copy of project-yamls/behat.google-example.yml, in the same directory, and rename it to something specific to your project.  
Replace the base_url (line 6) with the url where you want behat to start . 
### Features
It is recommended you make a base folder inside of features to hold all of your tests.  
Inside your project-specific features, you will be able to sort all of your tests how you see fit.  
### test.sh
Under BEHAT_PARAMETERS (lines 9 & 11), change the config to your desired project-yaml, and change 'features/trunk' to the path you chose to house your tests

## Debugging and Writing Tests
When writing the tests, or for demos, you might want to see what behat is doing in the background  
Steps (these commands reference the 'Makefile'):  
    make debug-start  
in Safari or Alfred, go to the url: vnc://localhost:5901  
Password: secret  
    make debug-run  
        Here, you can optionally add arguments with the argument 'features'  
        ex: make debug-run features=features/projectFolder  
For windows, you will need a 3rd party vnc client like RealVNC. The url and password are the same as above  

## Running all tests with a faster selenium
To run tests with the defaults you set on test.sh(9), simply run the command: sh test.sh  
To run a specific feature file, run the command: sh test.sh {path to your file/folder}
Examples below:  
    sh test.sh features/projectFolder  
    sh test.sh features/projectFolder/components/carousel.feature  

## Rapid development with faster selenium
test.sh will build and destroy the docker network every time you run the script.  
To start it manually, run the command from the root directory:  
docker-compose -f docker-compose.behat.yml up -d  
Then comment out lines 15-33, and uncomment line 30 (docker-compose -f docker-compose.behat.yml exec behat /srv/entrypoint.sh "$BEHAT_PARAMETERS")  
Now you can execute tests with test.sh much faster feedback loop.  
To stop your network when done with testing, run the command:  
docker-compose -f docker-compose.behat.yml down  