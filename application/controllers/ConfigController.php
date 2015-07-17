<?php

use Icinga\Web\Controller;

class SlaReports_ConfigController extends Controller
{
    public function indexAction()
    {
        $this->getTabs()->activate('config');
        #TODO set up configurations here.
    }
    public function getTabs()
    {
        $tabs = parent::getTabs();
        $tabs->add(
            'dashboard',
            array(
                'title' => 'Dashboard',
                'url'   => 'sla-reports'
            )
        );
        $tabs->add(
            'config',
            array(
                'title' => 'Configure',
                'url'   => 'sla-reports/config'
            )
        );

        return $tabs;
    }
}

