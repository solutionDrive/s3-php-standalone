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


Develop
-------

To create the executable phar archive you need to install `kherge/box` globally:
(The global composer bin path needs to be available in `$PATH`)

    composer global require kherge/box

Install the dependencies

    composer install --optimize-autoloader -n

Create the phar file

    box build -c box.json
    
Perhaps it is necessary to allow php to create a phar

    php -d phar.readonly=0 ~/.composer/vendor/bin/box build -c box.json

The newly created phar file can be used just like this:

    build/sd-s3-php-standalone.phar --help


Author
------

solutionDrive GmbH
info@solutionDrive.de


License
-------

MIT. For details see file `LICENSE`.
