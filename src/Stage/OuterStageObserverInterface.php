<?php
/**
 * Author: Courtney Miles
 * Date: 1/10/18
 * Time: 8:36 AM
 */

namespace MilesAsylum\Slurp\Stage;


interface OuterStageObserverInterface
{
    public function update(OuterStageInterface $stage): void;
}
