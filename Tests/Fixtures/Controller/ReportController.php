<?php

/*
 * This file is part of Handcrafted in the Alps - Rest Routing Bundle Project.
 *
 * (c) 2011-2020 FriendsOfSymfony <http://friendsofsymfony.github.com/>
 * (c) 2020 Sulu GmbH <hello@sulu.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HandcraftedInTheAlps\RestRoutingBundle\Tests\Fixtures\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\ControllerTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class ReportController.
 */
class ReportController extends AbstractController
{
    use ControllerTrait;

    public function getBillingSpendingsAction()
    {
    }

    /**
     * @Rest\Get("billing/spendings/{campaign}")
     */
    public function getBillingSpendingsByCampaignAction($campaign)
    {
    }

    public function getBillingPaymentsAction()
    {
    }

    public function getBillingEarningsAction()
    {
    }

    /**
     * @Rest\Get("billing/earnings/{platform}")
     */
    public function getBillingEarningsByPlatformAction($platform)
    {
    }

    public function getBillingWithdrawalsAction()
    {
    }
}
