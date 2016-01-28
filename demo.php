<?php
    require('./src/Algorithms/GraphTools/Point.php');
    require('./src/Algorithms/GraphTools/Creator.php');
    require('./src/Algorithms/GraphTools/PointException.php');
    
    $creator = new \Algorithms\GraphTools\Creator;
    $point = \Algorithms\GraphTools\Point::create(6);
    $creator->addPoint($point)
            ->addRelation(2, 6);

    print_r($creator->getPoint(6));
    print_r($point);
