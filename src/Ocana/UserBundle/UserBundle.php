<?php
/**
 * (c) Ismael Ocana <i.Ocana@gmail.com>
 *
 * @link        http://www.ismaelOcana.com
 * @copyright   Copyright (c) Ismael Ocana. (http://www.ismaelOcana.com)
 * @license     MIT License - http://en.wikipedia.org/wiki/MIT_License
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ocana\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class UserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}