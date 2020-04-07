<?php

namespace App\Command;

use App\Domain\Carrier\Carrier;
use App\Domain\Carrier\CarrierConfig;
use App\Domain\Product\Product;
use App\Infrastructure\Carrier\Repository\DoctrineCarrierRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateCarrierCommand extends Command
{
    protected static $defaultName = 'app:create-carriers';

    private DoctrineCarrierRepository $repository;

    public function __construct(DoctrineCarrierRepository $repository, string $name = null)
    {
        $this->repository = $repository;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setDescription('Command used to create carriers and configurations');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->note(sprintf('Creating carriers'));

        $carriers = $this->getCarriers();

        foreach ($carriers as $c) {
            $carrier = new Carrier($c['name']);

            foreach ($c['configuration'] as $config) {
                $carrierConfig = new CarrierConfig(
                    $config['minWeight'],
                    $config['maxWeight'],
                    $config['fixValue'],
                    $config['valueDistanceKilo']
                );

                $carrierConfig->setCarrier($carrier);

                $carrier->addConfig($carrierConfig);
            }

            $this->repository->persist($carrier);
        }

        $io->success(sprintf('Carriers and configurations created successfully'));

        return 1;
    }

    private function getCarriers(): array
    {
        return [
            [
                'name' => 'BoxDex',
                'configuration' => [
                    [
                        'minWeight' => 0.0,
                        'maxWeight' => 10000,
                        'fixValue' => 10,
                        'valueDistanceKilo' => 0.05
                    ]
                ]
            ],
            [
                'name' => 'BoaLog',
                'configuration' => [
                    [
                        'minWeight' => 0.0,
                        'maxWeight' => 10000,
                        'fixValue' => 4.30,
                        'valueDistanceKilo' => 0.12
                    ]
                ]
            ],
            [
                'name' => 'Transboa',
                'configuration' => [
                    [
                        'minWeight' => 0.0,
                        'maxWeight' => 5,
                        'fixValue' => 2.10,
                        'valueDistanceKilo' => 1.10
                    ],
                    [
                        'minWeight' => 5.01,
                        'maxWeight' => 10000,
                        'fixValue' => 10,
                        'valueDistanceKilo' => 0.01
                    ],
                ]
            ]
        ];
    }
}
