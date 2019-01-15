<?php
/**
 * Created by PhpStorm.
 * User: wizdom75
 * Date: 03/04/2018
 * Time: 19:03
 */

namespace App\classes;


class Request
{

    /**
     * REturn all request we are interested in.
     * @param bool $is_array
     * @return mixed
     */
    public static function all($is_array=false)
    {
        $result = [];

        if(count($_GET) > 0) $result['get'] = $_GET;
        if(count($_POST) > 0) $result['post'] = $_POST;

        $result['file'] = $_FILES;

        return json_decode(json_encode($result), $is_array);
    }

    /**
     * Get request type
     * @param $key
     * @return mixed
     */
    public static function get($key)
    {
        $obj = new static;

        $data = $obj->all();

        return $data->$key;
    }

    /**
     * Check request availability
     * @param $key
     * @return bool
     */
    public static function has($key)
    {
        return (array_key_exists($key, self::all(true))) ? true : false;
    }

    /**
     * Get old request data
     * @param $key
     * @param $value
     * @return string
     */
    public static function old($key, $value)
    {
        $obj = new static;

        $data = $obj->all();

       return isset($data->$key->$value) ? $data->$key->$value : '';
    }


    public static function refresh()
    {
        $_FILES = [];
        $_GET = [];
        $_POST = [];
    }
}