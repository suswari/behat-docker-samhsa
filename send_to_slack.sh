#!/bin/sh
OUT=$(./wsend ./reports/cucumber-html-reports/)
echo $OUT
curl -X POST -H 'Content-type: application/x-www-form-urlencoded' \
--data '{
       "attachments": [
        {
            "title": "Behat Test Report",
            "title_link": "'"${OUT}"'",
        }
    ]

}' \
https://hooks.slack.com/services/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
