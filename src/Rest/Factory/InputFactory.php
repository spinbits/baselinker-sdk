<?php
/**
 * @author Jakub Lech <info@smartbyte.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Spinbits\BaselinkerSdk\Rest\Factory;

use Spinbits\BaselinkerSdk\Rest\Input;

/** InputFactory */
class InputFactory
{
    /**
     * @param array $post
     *
     * @return Input
     */
    public static function createFromPostData(array $post): Input
    {
        return new Input($post);
    }
}
