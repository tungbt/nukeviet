<?php

/**
 * @Project NUKEVIET 3.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2013 VINADES.,JSC. All rights reserved
 * @createdate 07/30/2013 10:27
 */

if( ! defined( 'NV_ADMIN' ) ) die( 'Stop!!!' );

if( defined( 'NV_IS_SPADMIN' ) )
{
	$submenu['thumbconfig'] = $lang_module['thumbconfig'];
	$submenu['config'] = $lang_module['configlogo'];
	if( defined( 'NV_IS_GODADMIN' ) )
	{
		$submenu['uploadconfig'] = $lang_module['uploadconfig'];
	}
}

?>