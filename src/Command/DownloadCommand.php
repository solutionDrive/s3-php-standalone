<?php

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace sd\S3PhpStandalone\Command;

use sd\S3PhpStandalone\Factory\S3ClientFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DownloadCommand extends Command
{
    /** @var S3ClientFactory */
    private $clientFactory;

    public function __construct(
        $clientFactory = ''
    ) {
        parent::__construct();
        $this->clientFactory = $clientFactory;
    }

    protected function configure()
    {
        $this
            ->setName('s3:download')
            ->addArgument('bucket', InputArgument::REQUIRED, 'Bucket name')
            ->addArgument('key', InputArgument::REQUIRED, 'Remote path in bucket')
            ->addArgument('target', InputArgument::REQUIRED, 'Local target path')
            ->setDescription('Download a file from s3 bucket.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = $this->clientFactory->create();

        $key = $input->getArgument('key');
        $target = $input->getArgument('target');

        // Download data
        $result = $client->getObject([
            'Bucket'                     => $input->getArgument('bucket'),
            'Key'                        => $key,
            //'ResponseContentType'        => 'text/plain',
            //'ResponseContentLanguage'    => 'en-US',
            'ResponseContentDisposition' => 'attachment; filename=data',
            'ResponseCacheControl'       => 'No-cache',
            'ResponseExpires'            => gmdate(DATE_RFC2822, time() + 60),
        ]);

        file_put_contents($this->getFullTargetPath($key, $target), $result['Body']);
    }

    private function getFullTargetPath($key, $target)
    {
        if (is_file($target) && is_writable($target)) {
            return $target;
        }

        if (is_dir($target)) {
            $filename = basename($key);
            return rtrim($target, '/') . '/' . $filename;
        }

        // Target directory is given (that does not exist yet)
        if ('/' === substr($target, -1)) {
            $filename = basename($key);
            $target = rtrim($target, '/') . '/' . $filename;
        }

        // Create directories recursively
        $dirname = dirname($target);
        if (false === is_dir($dirname)) {
            mkdir($dirname, 0777, true);
        }

        return $target;
    }
}
