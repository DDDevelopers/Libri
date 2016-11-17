<?php
namespace AppBundle\Twig;

use AppBundle\Entity\Review;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;

class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('price', array($this, 'priceFilter')),
            new \Twig_SimpleFilter('avg', array($this, 'findAvarage')),
        );
    }

    public function priceFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = '$'.$price;

        return $price;
    }

    public function findAvarage(PersistentCollection $collection)
    {
        $counter = 0;
        $total = 0;
        foreach ($collection as $item) {
            if($item instanceof Review) {
                $total += $item->getRating();
                $counter ++;
            }
        }
        if ($total == 0) {
            return 0;
        }
        return $total / $counter;
    }

    public function getName()
    {
        return 'app_extension';
    }
}