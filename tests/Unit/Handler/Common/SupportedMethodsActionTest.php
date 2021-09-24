<?php
/**
 * @author Jakub Lech <info@smartbyte.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Spinbits\BaselinkerSdk\Tests\Unit\Handler\Common;

use Spinbits\BaselinkerSdk\Handler\Common\SupportedMethodsActionHandler;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Spinbits\BaselinkerSdk\RequestHandler;
use Spinbits\BaselinkerSdk\Rest\Input;

/** Class SupportedMethodsActionTest */
class SupportedMethodsActionTest extends TestCase
{
    /** @test */
    public function testHandle()
    {
        $input = $this->createMock(Input::class);
        $requestHandler = $this->createMock(RequestHandler::class);

        $requestHandler
            ->expects($this->once())
            ->method('supportedActions')
            ->willReturn(['example-action']);

        $sut = new SupportedMethodsActionHandler($requestHandler);
        $result = $sut->handle($input);

        $this->assertSame(['example-action'], $result);
    }
}
