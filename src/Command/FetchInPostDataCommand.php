<?php

namespace App\Command;

use App\Enum\Resource;
use App\Factory\InPostServiceFactory;
use App\Service\SerializerService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:fetch-inpost-data',
    description: 'Fetching inpost data.',
    hidden: false
)]
class FetchInPostDataCommand extends Command
{
    public function __construct(
        private readonly InPostServiceFactory $apiServiceFactory,
        private readonly SerializerService $serializerService
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('resource', InputArgument::REQUIRED)
             ->addArgument('city', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $resource = $input->getArgument('resource');
        $city = $input->getArgument('city');

        $apiService = $this->apiServiceFactory->create(Resource::fromString($resource));
        $response = $apiService->fetchData($city);
        $deserializedResponse = $this->serializerService->deserialize($response, $resource);

        dump($deserializedResponse);

        return Command::SUCCESS;
    }
}
