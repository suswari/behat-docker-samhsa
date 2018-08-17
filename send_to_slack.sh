#!/usr/bin/env bash

curl -X POST -H 'Content-type: application/x-www-form-urlencoded' \
--data '{
       "attachments": [
        {
            "title": "Behat Test Report",
            "title_link": "http://localhost:63342/behat-docker-samhsa/reports/cucumber-html-reports/overview-features.html",
        }
    ]

}' \
https://hooks.slack.com/services/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
