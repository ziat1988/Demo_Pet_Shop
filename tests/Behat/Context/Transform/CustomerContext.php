<?php

/*
 * This file is part of the Monofony demo project.
 *
 * (c) Monofony
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Tests\Behat\Context\Transform;

use Behat\Behat\Context\Context;
use Monofony\Bridge\Behat\Service\SharedStorageInterface;
use Sylius\Component\Customer\Model\CustomerInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Zenstruck\Foundry\Proxy;

final class CustomerContext implements Context
{
    private RepositoryInterface $customerRepository;
    private FactoryInterface $customerFactory;
    private SharedStorageInterface $sharedStorage;

    public function __construct(
        RepositoryInterface $customerRepository,
        FactoryInterface $customerFactory,
        SharedStorageInterface $sharedStorage,
    ) {
        $this->customerRepository = $customerRepository;
        $this->customerFactory = $customerFactory;
        $this->sharedStorage = $sharedStorage;
    }

    /**
     * @Transform :customer
     * @Transform /^customer "([^"]+)"$/
     */
    public function getOrCreateCustomerByEmail($email): object
    {
        /** @var CustomerInterface|null $customer */
        $customer = $this->customerRepository->findOneBy(['email' => $email]);
        if (null === $customer) {
            /** @var CustomerInterface $customer */
            $customer = $this->customerFactory->createNew();
            $customer->setEmail($email);

            $this->customerRepository->add($customer);
        }

        return $customer;
    }

    /**
     * @Transform /^(he|his|she|her|their|the customer of my account)$/
     */
    public function getLastCustomer(): CustomerInterface|Proxy
    {
        return $this->sharedStorage->get('customer');
    }
}
