<?php

namespace Icinga\Module\SlaReports;

use Icinga\Application\Config;
use Icinga\Exception\ConfigurationError;
use Icinga\Module\Monitoring\Object\MonitoredObject;
use Icinga\Module\Monitoring\Object\Host;
use Icinga\Module\Monitoring\Object\Service;
use Icinga\Web\Hook\GrapherHook;
use Icinga\Web\Url;

class Grid extends WebBaseHook
{
    protected $hasPreviews = true;



    protected $baseUrl = '/reports/sla';

    protected function init()
    {
        $cfg = Config::module('sla-reports')->getSection('sla-reports');
        $this->baseUrl   = rtrim($cfg->get('base_url', $this->baseUrl), '/');
    }


