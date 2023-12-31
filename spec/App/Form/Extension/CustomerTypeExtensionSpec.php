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

namespace spec\App\Form\Extension;

use App\Form\EventSubscriber\AddUserFormSubscriber;
use App\Form\Type\User\AppUserType;
use PhpSpec\ObjectBehavior;
use Sylius\Bundle\CustomerBundle\Form\Type\CustomerType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

class CustomerTypeExtensionSpec extends ObjectBehavior
{
    function it_extends_an_abstract_type_extension()
    {
        $this->shouldHaveType(AbstractTypeExtension::class);
    }

    function it_extends_customer_type()
    {
        $this::getExtendedTypes()->shouldReturn([CustomerType::class]);
    }

    function it_adds_user_form_subscriber(FormBuilderInterface $builder)
    {
        $builder->addEventSubscriber(new AddUserFormSubscriber(AppUserType::class))->shouldBeCalled();

        $this->buildForm($builder, []);
    }
}
