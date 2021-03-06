<?php
/**
 * Created by PhpStorm.
 * User: andrebian
 * Date: 29/06/18
 * Time: 22:41
 */

namespace BaseApplication\View\Helper;

use Laminas\View\Helper\AbstractHelper;

/**
 * Class ProductionEnvViewHelper
 * @package BaseApplication\View\Helper
 */
class ProductionEnvViewHelper extends AbstractHelper
{
    public function __invoke()
    {
        if ('cli-server' == php_sapi_name()) {
            return false;
        }

        if ((isset($_SERVER['SERVER_ADDR'])
            && strpos($_SERVER['SERVER_ADDR'], 'homologacao') !== false)
        || (isset($_SERVER['HTTP_HOST'])
            && strpos($_SERVER['HTTP_HOST'], 'homologacao') !== false)) {
            return false;
        }

        if (file_exists(__DIR__ . '/../../../../../config/autoload/local.php')) {
            $local = require __DIR__ . '/../../../../../config/autoload/local.php';
            if (isset($local['env']) && $local['env'] != 'prod') {
                return false;
            }
        }

        return true;
    }
}
