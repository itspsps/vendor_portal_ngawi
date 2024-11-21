<?php

function set_active($path, $active = 'active')
{
    return call_user_func_array('Request::is', (array) $path) ? $active : '';
}
function set_active_toggle($path, $active = 'active pcoded-trigger')
{
    return call_user_func_array('Request::is', (array) $path) ? $active : '';
}

function rupiah($list_masuktotal)
{
    $hasil_rupiah = "Rp. " . number_format($list_masuktotal, 0, ',', '.');
    return $hasil_rupiah;
}
function tonase($list_tonase)
{
    $hasil_tonase = number_format($list_tonase, 0, ',', '.') . " Kg";
    return $hasil_tonase;
}

if (!function_exists('prefixActive')) {
	function prefixActive($prefixName)
	{
		return	request()->route()->getPrefix() == $prefixName ? 'active' : '';
	}
}

if (!function_exists('prefixBlock')) {
	function prefixBlock($prefixName)
	{
		return	request()->route()->getPrefix() == $prefixName ? 'block' : 'none';
	}
}

if (!function_exists('routeActive')) {
	function routeActive($routeName)
	{
		return	request()->routeIs($routeName) ? 'active' : '';
	}
}

if (!function_exists('routeActiveBlock')) {
	function routeActiveBlock(array $routeNames)
	{
		foreach ($routeNames as $routeName) {
			if (request()->routeIs($routeName)) {
				return 'block';
			}
		}
		return 'none';
	}
}