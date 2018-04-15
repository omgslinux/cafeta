<?php

namespace AppBundle\Twig;

use Twig_Extension;
use AppBundle\Utils\Turno;

class TurnoExtension extends Twig_Extension
{

    public function getFilters()
    {
        return array(
          new \Twig_SimpleFilter('turnoStatus', array($this, 'turnoFilter')),
        );
    }

    public function turnoFilter($data)
    {
        return Turno::getName($data);
    }

    public function getName()
    {
        return 'turno_extension';
    }
}
