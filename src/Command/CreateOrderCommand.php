<?php

namespace App\Command;

use App\Domain\Order\Order;
use App\Infrastructure\Carrier\Repository\DoctrineCarrierRepository;
use App\Infrastructure\Order\Repository\DoctrineOrderRepository;
use App\Infrastructure\Product\Repository\DoctrineProductRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateOrderCommand extends Command
{
    protected static $defaultName = 'app:create-orders';

    private DoctrineOrderRepository $or;
    private DoctrineProductRepository $pr;
    private DoctrineCarrierRepository $cr;

    public function __construct(
        DoctrineOrderRepository $or,
        DoctrineProductRepository $pr,
        DoctrineCarrierRepository $cr,
        string $name = null)
    {
        $this->or = $or;
        $this->pr = $pr;
        $this->cr = $cr;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setDescription('Command used to create all possibles orders');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->note(sprintf('Creating orders'));

        $products = $this->getProducts();

        $carriers = $this->getCarriers();

        foreach ($carriers as $carrier) {
            foreach ($products as $product) {
                $this->or->persist(new Order(
                    (float) rand(1,1050),
                    $carrier,
                    $product
                ));
            }
        }

        $io->success(sprintf('Orders created successfully'));

        return 1;
    }

    public function getProducts()
    {
        return $this->pr->findAll();
    }

    public function getCarriers()
    {
        return $this->cr->findAll();
    }

}
