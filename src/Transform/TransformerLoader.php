<?php
/**
 * Author: Courtney Miles
 * Date: 14/08/18
 * Time: 9:57 PM
 */

namespace MilesAsylum\Slurp\Transform;

class TransformerLoader
{
    /**
     * @var TransformerInterface[]
     */
    private $loadedTransformers = [];

    /**
     * @param Transformation $transformation
     * @return TransformerInterface
     */
    public function loadTransformer(Transformation $transformation)
    {
        if (!isset($this->loadedTransformers[$transformation->transformedBy()])) {
            $transformedBy = $transformation->transformedBy();
            $this->loadedTransformers[$transformation->transformedBy()] = new $transformedBy;
        }

        return $this->loadedTransformers[$transformation->transformedBy()];
    }
}