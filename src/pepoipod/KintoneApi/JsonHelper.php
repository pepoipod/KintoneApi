<?php
/**
 * Created by PhpStorm.
 * User: iwamoto
 * Date: 2017/08/18
 * Time: 22:43
 */

namespace pepoipod\KintoneApi;


class JsonHelper
{
  /**
   * JSONファイルデータから連想配列を生成.
   *
   * @param $file
   * @return mixed
   */
  static function createJSON($file)
  {
    $json = json_decode(mb_convert_encoding($file, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN'), true);
    return $json;
  }

  /**
   * 連想配列をJSON文字列にエンコードする.
   *
   * @param $arr
   * @return string
   */
  static function encodeJSON($arr)
  {
    return json_encode($arr, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
  }
}
