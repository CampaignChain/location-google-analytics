<?php
/*
 * This file is part of the CampaignChain package.
 *
 * (c) CampaignChain Inc. <info@campaignchain.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CampaignChain\Location\GoogleAnalyticsBundle\CampaignChain;

use CampaignChain\DeploymentUpdateBundle\Service\CodeUpdateInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Style\SymfonyStyle;

class UpdateGoogleProfileEntities implements CodeUpdateInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getVersion()
    {
        return 20160630124400;
    }

    public function getDescription()
    {
        return [
            'Move every profileId -> property id',
            'Extract from the location url the real profileId',
            'Add the profileId to the profileId column and also for the identifier column',
        ];
    }

    public function execute(SymfonyStyle $io = null)
    {
        $currentProfiles = $this->entityManager
            ->getRepository('CampaignChainLocationGoogleAnalyticsBundle:Profile')
            ->findAll();

        if (empty($currentProfiles)) {
            $io->text('There is no Profile entity to update');

            return true;
        }

        foreach ($currentProfiles as $profile) {
            if (substr($profile->getProfileId(), 0, 2) != 'UA') {
                continue;
            }

            $profile->setPropertyId($profile->getProfileId());

            $gaProfileUrl = $profile->getLocation()->getUrl();
            $google_base_url = 'https:\/\/www.google.com\/analytics\/web\/#report\/visitors-overview\/a'.$profile->getAccountId().'w\d+p';
            $pattern = '/'.$google_base_url.'(.*)/';

            preg_match($pattern, $gaProfileUrl, $matches);

            if (!empty($matches) && count($matches) == 2) {
                $profile->setProfileId($matches[1]);
                $profile->setIdentifier($profile->getProfileId());
            }

            $this->entityManager->persist($profile);
        }

        $this->entityManager->flush();

        return true;
    }

}