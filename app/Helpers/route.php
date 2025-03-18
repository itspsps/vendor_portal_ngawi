<?php

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
