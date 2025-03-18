<?php

use Illuminate\Support\Str;

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
function getCode($value)
{
	$value = Str::substr($value, 0, 2) . '**************' . Str::substr($value, 20);
	return $value;
}
function getTanggal($date)
{
	$date = Str::substr($date, 0, 0) . '**-**-' . Str::substr($date, 6);
	return $date;
}
function getNopol($value)
{
	$value = Str::substr($value, 0, 2) . '*****' . Str::substr($value, 7);
	return $value;
}
function getTonase($value)
{
	$value = Str::substr($value, 0, 2) . '*****' . Str::substr($value, 6);
	return $value;
}
function getHarga($value)
{
	$value = Str::substr($value, 0, 0) . '*******' . Str::substr($value, 10);
	return $value;
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
function replace_titik($value)
{
	$replace = (Str_replace('-', '', $value));
	return $replace;
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
