<?php

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace sd\S3PhpStandalone\Factory;

use Aws\S3\S3Client;

class S3ClientFactory
{
    /** @var string */
    private $region;

    /** @var string */
    private $version;

    /** @var string */
    private $profile;

    public function __construct(
        $region = 'eu-central-1',
        $version = 'latest',
        $profile = 'default'
    ) {
        $this->region = $region;
        $this->version = $version;
        $this->profile = $profile;
    }

    public function create()
    {
        return new S3Client([
            'version' => $this->version,
            'region'  => $this->region,
            'profile' => $this->profile,
        ]);
    }
}
