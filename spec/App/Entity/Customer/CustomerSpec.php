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

namespace spec\App\Entity\Customer;

use Monofony\Contracts\Core\Model\Customer\CustomerInterface;
use Monofony\Contracts\Core\Model\User\AppUserInterface;
use PhpSpec\ObjectBehavior;
use Sylius\Component\Customer\Model\Customer as BaseCustomer;
use Sylius\Component\User\Model\UserInterface;

class CustomerSpec extends ObjectBehavior
{
    function it_implements_a_customer_interface(): void
    {
        $this->shouldImplement(CustomerInterface::class);
    }

    function it_extends_a_base_customer_model(): void
    {
        $this->shouldBeAnInstanceOf(BaseCustomer::class);
    }

    function it_has_no_user_by_default(): void
    {
        $this->getUser()->shouldReturn(null);
    }

    function its_user_is_mutable(AppUserInterface $user): void
    {
        $user->setCustomer($this)->shouldBeCalled();

        $this->setUser($user);
        $this->getUser()->shouldReturn($user);
    }

    function it_throws_an_invalid_argument_exception_when_user_is_not_an_app_user_type(UserInterface $user)
    {
        $this->shouldThrow(\InvalidArgumentException::class)->during('setUser', [$user]);
    }

    function it_resets_customer_of_previous_user(AppUserInterface $previousUser, AppUserInterface $user)
    {
        $this->setUser($previousUser);

        $previousUser->setCustomer(null)->shouldBeCalled();

        $this->setUser($user);
    }

    function it_does_not_replace_user_if_it_is_already_set(AppUserInterface $user)
    {
        $user->setCustomer($this)->shouldBeCalledOnce();

        $this->setUser($user);
        $this->setUser($user);
    }
}
