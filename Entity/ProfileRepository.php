<?php
/*
 * This file is part of the CampaignChain package.
 *
 * (c) CampaignChain Inc. <info@campaignchain.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CampaignChain\Location\GoogleAnalyticsBundle\Entity;
use Doctrine\ORM\EntityRepository;


class ProfileRepository extends EntityRepository
{
    public function getGoogleIds(){
        $qb = $this->createQueryBuilder('p')
            ->select('p.profileId');

        return array_map(function($row){
            return $row['profileId'];
        }, $qb->getQuery()->getArrayResult());
    }
}
