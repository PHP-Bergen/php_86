<?php

use Time\Duration;

$oneSecond = Duration::fromSeconds(1);
$halfSecond = $oneSecond->divideBy(2);
$onePointFiveSeconds = $oneSecond->add($halfSecond);

