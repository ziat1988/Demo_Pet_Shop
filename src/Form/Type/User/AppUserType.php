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

namespace App\Form\Type\User;

use App\Entity\User\AppUser;
use Sylius\Bundle\UserBundle\Form\Type\UserType;
use Symfony\Component\Form\FormBuilderInterface;

class AppUserType extends UserType
{
    public function __construct()
    {
        parent::__construct(AppUser::class, ['sylius']);
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $builder
            ->remove('username')
            ->remove('email');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'sylius_app_user';
    }
}
