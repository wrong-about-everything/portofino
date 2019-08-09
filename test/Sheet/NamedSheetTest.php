<?php

declare(strict_types=1);

namespace Portofino\Tests\Sheet;

use PHPUnit\Framework\TestCase;
use Portofino\Cell;
use Portofino\Cell\StringCell;
use Portofino\Header\BoldedHeader;
use Portofino\Row\DefaultRow;
use Portofino\Sheet\NamedSheet;

class NamedSheetTest extends TestCase
{
    public function testSuccessful()
    {
        $result =
            (new NamedSheet(
                $this->sheetName(),
                new BoldedHeader(
                    new StringCell('col1'),
                    new StringCell('col2')
                ),
                new DefaultRow(
                    new StringCell('cell1-1'),
                    new StringCell('cell1-2')
                ),
                new DefaultRow(
                    new StringCell('cell2-1'),
                    new StringCell('cell2-2')
                )
            ));

        $this->assertEquals($result->name(), $this->sheetName());
        $this->assertEquals(
            [['col1', 'col2'], ['cell1-1', 'cell1-2'], ['cell2-1', 'cell2-2']],
            array_map(
                function (array $cells) {
                    return
                        array_map(
                            function (Cell $cell) {
                                return
                                    $cell->value();
                            },
                            $cells
                        );
                },
                $result->value()
            )
        );
    }

    private function sheetName(): string
    {
        return 'sheet test name';
    }
}
