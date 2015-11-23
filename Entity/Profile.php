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

use CampaignChain\CoreBundle\Entity\Location;
use Doctrine\ORM\Mapping as ORM;

/**
 * Profile
 *
 * @ORM\Table(name="campaignchain_location_google_analytics_profile")
 * @ORM\Entity(repositoryClass="CampaignChain\Location\GoogleAnalyticsBundle\Entity\ProfileRepository")
 */
class Profile
{
    CONST METRIC_PAGEVIEW = 'ga:pageviews';
    CONST METRIC_SESSION = 'ga:sessions';
    CONST METRIC_VISITORS = 'ga:visitors';
    CONST SEGMENT_ORGANIC = 'gaid::-5';
    CONST SEGMENT_DIRECT = 'gaid::-7';
    CONST SEGMENT_PAID = 'gaid::-4';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="CampaignChain\CoreBundle\Entity\Location")
     */
    protected $location;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    protected $identifier;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $accountId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $profileId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $displayName;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    protected $metrics=['ga:sessions'];

    public static function getMetricsArray() {
        return [
            self::METRIC_PAGEVIEW => 'Pageviews',
            self::METRIC_SESSION => 'Sessions',
            self::METRIC_VISITORS => 'Visitors',
        ];
    }


    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $segment;

    public static function getSegmentsArray() {
        return [
            0 => 'None',
            self::SEGMENT_DIRECT => 'Direct',
            self::SEGMENT_ORGANIC => 'Organic',
            self::SEGMENT_PAID => 'Paid',

        ];
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set identifier
     *
     * @param string $identifier
     * @return Profile
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * Get identifier
     *
     * @return string 
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @return Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @param mixed $accountId
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
    }

    /**
     * @return mixed
     */
    public function getProfileId()
    {
        return $this->profileId;
    }

    /**
     * @param mixed $profileId
     */
    public function setProfileId($profileId)
    {
        $this->profileId = $profileId;
    }

    /**
     * @return mixed
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @param mixed $displayName
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
    }

    /**
     * @return mixed
     */
    public function getMetrics()
    {
        return $this->metrics;
    }

    /**
     * @param mixed $metrics
     */
    public function setMetrics($metrics)
    {
        $this->metrics = $metrics;
    }

    /**
     * @return mixed
     */
    public function getSegment()
    {
        return $this->segment;
    }

    /**
     * @param mixed $segment
     */
    public function setSegment($segment)
    {
        $this->segment = $segment;
    }



}
