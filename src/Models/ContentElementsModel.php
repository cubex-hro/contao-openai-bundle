<?php

namespace Codebuster\ContaoOpenaiBundle\Models;

use Contao\Model;

class ContentElementsModel extends Model
{
    /**
     * Table name
     * @var string
     */
    protected static $strTable = 'tl_content';

    public static function findByPid($intPid, array $arrOptions = array())
    {

        static::$strTable = 'tl_content';
        $t = static::$strTable;
        $time = time();

        $arrColumns = array("$t.pid=$intPid AND $t.invisible='' AND ($t.start='' OR $t.start<$time) AND ($t.stop='' OR $t.stop>$time) ORDER BY sorting");

        return static::findBy($arrColumns, $arrOptions);
    }

}