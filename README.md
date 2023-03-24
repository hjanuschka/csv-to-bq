# Email with CSV Attachment to BigQuery



## Run

```
docker compose build
docker compose up -d 
cd lab/
./send.sh # this will send 1.csv via local smtp server
```

> SMTP-CLI is perl - maybe you need one or more CPAN modules


## Deploy
Make sure mailin is not exposed to the official internet!!!

deploy the 2 pods and forward myemail@evil.com to something@ip.address.of.the.mailin.pod


## Infra
### Mailin
Node based SMTP server receives email, and forwards it to a webhook.
### webhook
Sample PHP to get B64 of the sent in attachments
plus ficitional construction of a big query insert



