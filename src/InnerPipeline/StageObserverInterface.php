<?php
/**
 * Author: Courtney Miles
 * Date: 6/09/18
 * Time: 10:37 PM
 */

namespace MilesAsylum\Slurp\InnerPipeline;

interface StageObserverInterface
{
    public function update(StageInterface $stage): void;
}