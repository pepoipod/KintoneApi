<?php
/**
 * Created by PhpStorm.
 * User: iwamoto
 * Date: 2017/08/18
 * Time: 22:49
 */

namespace pepoipod\KintoneApi;

/**
 * Recordの取得、出力を簡易化するクラス.
 *
 * Class Record
 * @package pepoipod\KintoneApi
 */
class Record extends \ArrayObject
{
  /**
   * レコードのkeyに対応したvalueを取得する.
   *
   * @param $key
   * @return float|null
   */
  function getValue($key)
  {
    $val = isset($this['record'][$key]['value']) ? $this['record'][$key]['value'] : null;
    return is_numeric($val) ? ceil(floatval($val)) : $val;
  }

  /**
   * レコードのkeyに対応したvalueを出力する.
   *
   * @param $key
   * @return float|null
   */
  function printValue($key)
  {
    $val = isset($this['record'][$key]['value']) ? $this['record'][$key]['value'] : '';
    echo is_numeric($val) ? ceil(floatval($val)) : $val;
  }
}
