<?php

/*
 * This file is part of Handcrafted in the Alps - Rest Routing Bundle Project.
 *
 * (c) Sulu GmbH <hello@sulu.io>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
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
