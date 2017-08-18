<?php
/**
 * Created by PhpStorm.
 * User: iwamoto
 * Date: 2017/08/18
 * Time: 22:33
 */

namespace pepoipod\KintoneApi;


class Api
{
  const API_URL = 'https://otera.cybozu.com/k/v1/record.json';
  const APP_ID = '';

  const KINTONE_USER_NAME = '';
  const KINTONE_LOGIN_PASSWORD = '';

  private $base_header;

  /**
   * KintoneApi constructor.
   */
  function __construct()
  {
    $this -> base_header = [
      'X-Cybozu-Authorization: ' . base64_encode(self::KINTONE_USER_NAME . ':' . self::KINTONE_LOGIN_PASSWORD)
    ];
  }

  /**
   * APIに送信するリクエストヘッダー、ボディを組み立てる.
   *
   * @param $method
   * @param array $content
   * @return resource
   */
  private function buildContext($method, $content = [])
  {
    $options = [];

    switch ($method) {
      case 'GET':
        $options = [
          'http' => [
            'method' => $method,
            'header' => implode("\r\n", $this -> base_header)
          ]
        ];
        break;
      case 'POST':
      case 'PUT':
        $header = $this -> base_header;
        $header[] = 'Content-Type: application/json';

        $options = [
          'http' => [
            'method' => $method,
            'header' => implode("\r\n", $header),
            'content' => json_encode($content)
          ]
        ];
        break;
    }

    return stream_context_create($options);
  }

  /**
   * レコードを取得する.
   *
   * @param $record_id
   * @return mixed
   */
  function getRecord($record_id)
  {
    $url = self::API_URL . '?app=' . self::APP_ID . '&id=' . $record_id;
    $context = $this -> buildContext('GET');
    $result = @file_get_contents($url, false, $context);

    $json = JsonHelper ::createJSON($result);

    return new Record($json);
  }

  /**
   * レコードを送信、更新する.
   *
   * @param $content
   * @param $record_id
   * @return mixed
   */
  function postRecord($content, $record_id = 0)
  {
    $url = self::API_URL;
    $content['app'] = self::APP_ID;
    $method = 'POST';

    if ($record_id != 0) {
      $content['id'] = $record_id;
      $method = 'PUT';
    }

    $context = $this -> buildContext($method, $content);
    $result = @file_get_contents($url, false, $context);

    $json = JsonHelper ::createJSON($result);
    return $json;
  }
}
