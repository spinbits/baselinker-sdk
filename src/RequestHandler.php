<?php
/**
 * @author Jakub Lech <info@smartbyte.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Spinbits\BaselinkerSdk;

use Spinbits\BaselinkerSdk\Handler\HandlerInterface;
use Spinbits\BaselinkerSdk\Rest\Exception\ForbiddenException;
use Spinbits\BaselinkerSdk\Rest\Exception\InvalidArgumentException;
use Spinbits\BaselinkerSdk\Rest\Exception\RestException;
use Spinbits\BaselinkerSdk\Rest\Input;
use Spinbits\BaselinkerSdk\Rest\Response;
use Spinbits\BaselinkerSdk\Rest\ResponseError;
use Spinbits\BaselinkerSdk\Rest\ResponseInterface;
use \Exception;

class RequestHandler
{
    private const HANDLER_NOT_FOUND = 'Handler for action "%s" is not configured. Please use "setHandler" to map it.';

    /** @var HandlerInterface[] */
    private array $handlers = [];

    private string $password;

    /**
     * @param string $password
     */
    public function __construct(string $password)
    {
        $this->password = $password;
    }

    /**
     * @param Input $input
     * @return ResponseInterface
     */
    public function handle(Input $input): ResponseInterface
    {
        try {
            $this->checkPassword($input);
            $this->checkAction($input);
            $handler = $this->handlers[(string) $input->action()];

            return new Response($handler->handle($input));
        } catch (Exception $e) {
            return new ResponseError($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param string $action
     * @param HandlerInterface $handler
     */
    public function registerHandler(string $action, HandlerInterface $handler): void
    {
        $this->handlers[$action] = $handler;
    }

    public function supportedActions(): array
    {
        return array_keys($this->handlers);
    }

    /**
     * @param Input $input
     * @throws RestException
     */
    private function checkAction(Input $input): void
    {
        if (null === $input->action()) {
            throw new InvalidArgumentException("Missing action parameter");
        }
        if (!isset($this->handlers[$input->action()])) {
            throw new InvalidArgumentException(sprintf(self::HANDLER_NOT_FOUND, $input->action()));
        }
    }
    /**
     * @param Input $input
     *
     * @throws ForbiddenException
     * @throws RestException
     */
    private function checkPassword(Input $input): void
    {
        if (null === $input->password()) {
            throw new InvalidArgumentException("Missing password parameter", );
        }
        if ($input->password() !== $this->password) {
            throw new ForbiddenException("Wrong password");
        }
    }
}
