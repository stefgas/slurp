<?php
/**
 * Author: Courtney Miles
 * Date: 26/08/18
 * Time: 11:25 AM
 */

namespace MilesAsylum\Slurp\OuterPipeline;

use MilesAsylum\Slurp\Load\LoaderInterface;
use MilesAsylum\Slurp\Slurp;

class FinaliseStage extends AbstractOuterStage
{
    /**
     * @var LoaderInterface
     */
    private $loader;

    const STATE_FINALISED = 'finalised';

    public function __construct(LoaderInterface $loader)
    {
        $this->loader = $loader;
    }

    public function __invoke(Slurp $slurp): Slurp
    {
        $this->notify(self::STATE_BEGIN);

        // Note that the OuterProcessor will not call this stage if aborted.
        // This logic is a precaution where it may be used with another
        // processor.
        if (!$slurp->isAborted() && !$this->loader->isAborted()) {
            $this->loader->finalise();
            $this->notify(self::STATE_FINALISED);
        }

        $this->notify(self::STATE_END);

        return $slurp;
    }
}
