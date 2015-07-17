<?php
/*
TODO Things that need to be added:

- Option to show only hard or soft states 
- The ability to configure box size, or set it to dynamically fill the screen

- Add a filter and custom label so two dashboards could provide different labeled views.
(you may have two  dashboards with two different filters open- one for each dev team/environment/project)

*/


use Icinga\Data\Filter\Filter;
use Icinga\Module\Monitoring\Controller;
use Icinga\Module\Monitoring\Object\Host;
use Icinga\Module\Monitoring\Object\Service;
use Icinga\Web\Url;

#FIXME should this be Controller or ModuleActionController? The documentation was unclear.
class SlaReports_IndexController extends Controller
{
    public function indexAction()
    {
        $this->getTabs()->activate('dashboard');
        $this->setAutorefreshInterval(10);
	$this->view->recentAlerts = $this->createRecentAlerts();
    }


    # Create the tabs for the dashboard and the configuration tab.
    public function getTabs()
    {
        $tabs = parent::getTabs();
        $tabs->add(
            'dashboard',
            array(
                'title' => $this->translate('Dashboard'),
                'url'   => 'sla-reports',
                'tip'  => $this->translate('Overview')
            )
        );
        $tabs->add(
            'config',
            array(
                'title' => $this->translate('Configure'),
                'url'   => 'sla-reports/config',
                'tip'  => $this->translate('Configure')
            )
        );

        return $tabs;
    }

    /**
     * Top recent alerts
     *
     * @return mixed
     */
    private function createRecentAlerts()
    {
        $query = $this->backend->select()->from(
            'notification',
            array(
                'host_name',
                'host_display_name',
                'service_description',
                'service_display_name',
                'notification_output',
                'notification_contact_name',
                'notification_start_time',
                'notification_state'
            )
        );
        $this->applyRestriction('monitoring/filter/objects', $query);

        $query->order('notification_start_time', 'desc');

        return $query->limit(5);
    }

}

