<?php

declare(strict_types=1);

namespace Portofino\Style;

use Portofino\Style;
use Portofino\Style\Font\Colored;

class WithColoredFont implements Style
{
    private $color;
    private $style;

    public function __construct(Color $color, Style $style)
    {
        $this->color = $color;
        $this->style = $style;
    }

    public function font(): Font
    {
        return
            new Colored(
                $this->color,
                $this->style->font()
            );
    }

    public function backgroundColor(): Color
    {
        return
            $this->style->backgroundColor();
    }

    public function autoSized(): bool
    {
        return
            $this->style->autoSized();
    }
}