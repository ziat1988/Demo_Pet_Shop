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

namespace App\DataFixtures;

use App\Story\RandomAppUsersStory;
use App\Story\RandomBookingsStory;
use App\Story\RandomPetsStory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class FakeFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        RandomAppUsersStory::load();
        RandomPetsStory::load();
        RandomBookingsStory::load();
    }

    public static function getGroups(): array
    {
        return ['fake'];
    }
}
