<?php
/**
 * @author Jakub Lech <info@smartbyte.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Spinbits\BaselinkerSdk\Rest;

/** Input */
class Input
{
    private const POST_PASSWORD_FIELD = 'bl_pass';
    private const POST_ACTION_FIELD = 'action';

    /** @var ParameterBag */
    public $body;

    /**
     * @param array<string, mixed> $postData
     */
    public function __construct(array $postData)
    {
        $this->body = new ParameterBag($postData);
    }

    /**
     * @return string
     */
    public function action(): ?string
    {
        return $this->body->get(self::POST_ACTION_FIELD);
    }

    public function password(): ?string
    {
        return $this->body->get(self::POST_PASSWORD_FIELD);

    }
}
