#!/bin/sh
./smtp-cli --host localhost:25 \
           --from test@domain.com --to user@another.domain.org \
           --subject "Simple test with attachments" \
           --body-plain "Log files are attached." \
           --missing-modules-ok \
           --attach 1.csv@text/plain 
