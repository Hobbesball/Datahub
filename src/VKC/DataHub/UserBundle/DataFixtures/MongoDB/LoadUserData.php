<?php

namespace VKC\DataHub\UserBundle\DataFixtures\MongoDB;

use VKC\DataHub\SharedBundle\DataFixtures\EnvironmentSpecificDataFixture as AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use VKC\DataHub\UserBundle\Document\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    const DEFAULT_ADMIN_USERNAME = 'admin';
    const DEFAULT_ADMIN_PASSWORD = 'vkcdatahub';

    /**
     * {@inheritDoc}
     */
    protected function doLoad(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername(static::DEFAULT_ADMIN_USERNAME);
        $userAdmin->setPlainPassword(static::DEFAULT_ADMIN_PASSWORD);
        $userAdmin->setEmail('testuser+vkcdatahub@inuits.eu');
        $userAdmin->setEnabled(true);
        $userAdmin->addRole('ROLE_SUPER_ADMIN');

        $manager->persist($userAdmin);
        $manager->flush();

        $this->addReference('admin-user', $userAdmin);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 0;
    }
}
