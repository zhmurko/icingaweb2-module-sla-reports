<?php

$section = $this->menuSection($this->translate('Reporting'))
    ->add($this->translate('SLA Reports'), array(
          'icon'  => 'dashboard',
          'priority'  => 120))
    ->setUrl('sla-reports');
