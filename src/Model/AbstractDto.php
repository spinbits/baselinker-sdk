<?php
/**
 * @author Marcin Hubert <hubert.m.j@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Spinbits\BaselinkerSdk\Model;

use \ReflectionClass;

abstract class AbstractDto
{
    protected array $customHandlers = [];
    private array $_originalData;

    public function __construct(array $input)
    {
        $this->_originalData = $input;
        foreach ($input as $key => $value) {
            if (isset($this->customHandlers[$key])) {
                $this->customHandlers[$key]($key, $value);
                continue;
            }

            $this->{$key} = $this->cast($key, $value);
        }
    }

    private function cast(string $name, $value)
    {
        $reflection = new ReflectionClass($this);
        switch ($reflection->getProperty($name)->getType()->getName()) {
            case 'bool':
                return (bool) $value;
            case 'float':
                return (float) $value;
            case 'int':
                return (int) $value;
            case 'string':
            default:
                return (string) $value;
        }
    }

    public function getOriginalData(): array
    {
        return $this->_originalData;
    }
}
