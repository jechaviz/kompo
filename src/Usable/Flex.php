<?php

namespace Kompo;

use Kompo\Interactions\Traits\ForwardsInteraction;
use Kompo\Interactions\Traits\HasInteractions;
use Kompo\Komponents\Layout;
use Kompo\Komponents\Traits\HasHref;
use Kompo\Komponents\Traits\VerticalAlignmentTrait;

class Flex extends Layout
{
    use HasInteractions, ForwardsInteraction;
    use VerticalAlignmentTrait;
    use HasHref;

    public $vueComponent = 'Flex';
    public $bladeComponent = 'Flex';

    protected function vlInitialize($label)
    {
        parent::vlInitialize($label);

        $this->justifyStart();

        $this->alignCenter();
    }

    /**
     * Justify the content of the columns to the start.
     *
     * @return self 
     */
    public function justifyStart()
    {
        $this->config(['justifyClass' => '']);
        return $this;
    }


    /**
     * Justify the content of the columns to the center.
     *
     * @return self 
     */
    public function justifyCenter()
    {
        $this->config(['justifyClass' => 'vlJustifyCenter']);
        return $this;
    }


    /**
     * Justify the content of the columns to the end.
     *
     * @return self 
     */
    public function justifyEnd()
    {
        $this->config(['justifyClass' => 'vlJustifyEnd']);
        return $this;
    }


    /**
     * Justify the content of the columns with space between.
     *
     * @return self 
     */
    public function justifyBetween()
    {
        $this->config(['justifyClass' => 'vlJustifyBetween']);
        return $this;
    }


    /**
     * Justify the content of the columns with space around.
     *
     * @return self 
     */
    public function justifyAround()
    {
        $this->config(['justifyClass' => 'vlJustifyAround']);
        return $this;
    }
}
