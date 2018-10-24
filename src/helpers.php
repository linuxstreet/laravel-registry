<?php

/**
 * Get value from registry for a given key
 *
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
if (! function_exists('registry')) {
    function registry(string $key, $default = null)
    {
        return \Linuxstreet\Registry\Registry::get($key, $default);
    }
}
