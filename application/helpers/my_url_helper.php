<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('admin_url'))
{
	function admin_url($uri = '', $protocol = NULL)
	{
		return get_instance()->config->admin_url($uri, $protocol);
	}
}

// if ( ! function_exists('seller_url'))
// {
// 	function seller_url($uri = '', $protocol = NULL)
// 	{
// 		return get_instance()->config->seller_url($uri, $protocol);
// 	}
// }