<?php

namespace App\Command;

use App\Domain\Product\Product;
use App\Infrastructure\Product\Repository\DoctrineProductRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateProductCommand extends Command
{
    protected static $defaultName = 'app:create-products';

    private DoctrineProductRepository $repository;

    public function __construct(DoctrineProductRepository $repository, string $name = null)
    {
        $this->repository = $repository;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setDescription('Command used to create products');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->note(sprintf('Creating products'));

        $products = $this->getProducts();

        foreach ($products as $p) {
            $product = new Product($p['name'], $p['weight']);
            $this->repository->persist($product);
        }

        $io->success(sprintf('Products created successfully'));

        return 1;
    }

    private function getProducts(): array
    {
        return [
            [
                'name' => 'Fone de ouvido',
                'weight' => 1
            ],
            [
                'name' => 'Controle Xbox',
                'weight' => 3
            ],
            [
                'name' => 'Pc Gamer',
                'weight' => 35
            ],
            [
                'name' => 'Kit Gamer',
                'weight' => 5
            ],
            [
                'name' => 'Teclado + Fone',
                'weight' => 6
            ],
        ];
    }
}
