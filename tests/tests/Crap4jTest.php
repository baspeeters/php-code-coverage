<?php declare(strict_types=1);
/*
 * This file is part of the php-code-coverage package.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SebastianBergmann\CodeCoverage\Report;

use SebastianBergmann\CodeCoverage\RuntimeException;
use SebastianBergmann\CodeCoverage\TestCase;

/**
 * @covers SebastianBergmann\CodeCoverage\Report\Crap4j
 */
class Crap4jTest extends TestCase
{
    public function testForBankAccountTest(): void
    {
        $crap4j = new Crap4j;

        $this->assertStringMatchesFormatFile(
            TEST_FILES_PATH . 'BankAccount-crap4j.xml',
            $crap4j->process($this->getCoverageForBankAccount(), null, 'BankAccount')
        );
    }

    public function testForFileWithIgnoredLines(): void
    {
        $crap4j = new Crap4j;

        $this->assertStringMatchesFormatFile(
            TEST_FILES_PATH . 'ignored-lines-crap4j.xml',
            $crap4j->process($this->getCoverageForFileWithIgnoredLines(), null, 'CoverageForFileWithIgnoredLines')
        );
    }

    public function testForClassWithAnonymousFunction(): void
    {
        $crap4j = new Crap4j;

        $this->assertStringMatchesFormatFile(
            TEST_FILES_PATH . 'class-with-anonymous-function-crap4j.xml',
            $crap4j->process($this->getCoverageForClassWithAnonymousFunction(), null, 'CoverageForClassWithAnonymousFunction')
        );
    }

    public function testCrap4jThrowsRuntimeExceptionWhenUnableToWriteToTarget(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Could not write to "stdout://"');

        $Crap4j = new Crap4j;
        $Crap4j->process($this->getCoverageForBankAccount(), 'stdout://');
    }

    public function testCrap4jThrowsRuntimeExceptionWhenTargetDirWasNotCreated(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Directory "/foo/bar" was not created');

        $Crap4j = new Crap4j;
        $Crap4j->process($this->getCoverageForBankAccount(), '/foo/bar/baz');
    }
}
