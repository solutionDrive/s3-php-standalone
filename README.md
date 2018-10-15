s3-php-standalone
=================

Can interact with AWS S3 buckets without other dependencies than PHP.


Usage
-----

    sd-s3-php-standalone.phar download BUCKETNAME KEY_IN_BUCKET TARGET_FILE
    
Provide AWS IAM credentials as described in
https://docs.aws.amazon.com/de_de/sdk-for-php/v3/developer-guide/guide_credentials.html#default-credential-chain .

Please note that due to limitations of the default credential provider of the `aws-sdk-php` 
and for simplicity's sake there is no possibility to do an `assumeRole` by now.


Author
------

solutionDrive GmbH
info@solutionDrive.de


License
-------

MIT. For details see file `LICENSE`.
