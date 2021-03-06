<?php

/**
 * @Project NUKEVIET 3.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2012 VINADES.,JSC. All rights reserved
 * @createdate 12/31/2009 0:51
 */

if( ! defined( 'NV_IS_MOD_NEWS' ) ) die( 'Stop!!!' );

/**
 * viewcat_grid_new()
 *
 * @param mixed $array_catpage
 * @param mixed $catid
 * @param mixed $generate_page
 * @return
 */
function viewcat_grid_new( $array_catpage, $catid, $generate_page )
{
	global $module_name, $module_file, $lang_module, $module_config, $module_info, $global_array_cat, $page;
	$xtpl = new XTemplate( 'viewcat_grid.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'IMGWIDTH1', $module_config[$module_name]['homewidth'] );
	if( ! empty( $catid ) )
	{
		if( ($global_array_cat[$catid]['viewdescription'] AND $page == 1) OR $global_array_cat[$catid]['viewdescription'] == 2 )
		{
			$xtpl->assign( 'CONTENT', $global_array_cat[$catid] );
			if( $global_array_cat[$catid]['image'] )
			{
				$xtpl->assign( 'HOMEIMG1', NV_BASE_SITEURL . NV_FILES_DIR . '/' . $module_name . '/' . $global_array_cat[$catid]['image'] );
				$xtpl->parse( 'main.viewdescription.image' );
			}
			$xtpl->parse( 'main.viewdescription' );
		}
	}

	$a = 0;
	foreach( $array_catpage as $array_row_i )
	{
		$array_row_i['publtime'] = nv_date( 'd/m/Y h:i:s A', $array_row_i['publtime'] );
		$xtpl->clear_autoreset();
		$xtpl->assign( 'CONTENT', $array_row_i );
		if( defined( 'NV_IS_MODADMIN' ) )
		{
			$xtpl->assign( 'ADMINLINK', nv_link_edit_page( $array_row_i['id'] ) . '&nbsp;-&nbsp;' . nv_link_delete_page( $array_row_i['id'] ) );
			$xtpl->parse( 'main.viewcatloop.adminlink' );
		}
		if( $array_row_i['imghome'] != '' )
		{
			$xtpl->assign( 'HOMEIMG1', $array_row_i['imghome'] );
			$xtpl->assign( 'HOMEIMGALT1', ! empty( $array_row_i['homeimgalt'] ) ? $array_row_i['homeimgalt'] : $array_row_i['title'] );
			$xtpl->parse( 'main.viewcatloop.image' );
		}
		$xtpl->set_autoreset();
		$xtpl->parse( 'main.viewcatloop' );
		++$a;
	}
	if( ! empty( $generate_page ) )
	{
		$xtpl->assign( 'GENERATE_PAGE', $generate_page );
		$xtpl->parse( 'main.generate_page' );
	}
	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * viewcat_list_new()
 *
 * @param mixed $array_catpage
 * @param mixed $catid
 * @param mixed $page
 * @param mixed $generate_page
 * @return
 */
function viewcat_list_new( $array_catpage, $catid, $page, $generate_page )
{
	global $module_name, $module_file, $lang_module, $module_config, $module_info, $global_array_cat;
	$xtpl = new XTemplate( 'viewcat_list.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'IMGWIDTH1', $module_config[$module_name]['homewidth'] );
	if( ($global_array_cat[$catid]['viewdescription'] AND $page == 0) OR $global_array_cat[$catid]['viewdescription'] == 2 )
	{
		$xtpl->assign( 'CONTENT', $global_array_cat[$catid] );
		if( $global_array_cat[$catid]['image'] )
		{
			$xtpl->assign( 'HOMEIMG1', NV_BASE_SITEURL . NV_FILES_DIR . '/' . $module_name . '/' . $global_array_cat[$catid]['image'] );
			$xtpl->parse( 'main.viewdescription.image' );
		}
		$xtpl->parse( 'main.viewdescription' );
	}

	$a = $page;
	foreach( $array_catpage as $array_row_i )
	{
		$array_row_i['publtime'] = nv_date( 'd/m/Y h:i:s A', $array_row_i['publtime'] );
		$xtpl->clear_autoreset();
		$xtpl->assign( 'NUMBER', ++$a );
		$xtpl->assign( 'CONTENT', $array_row_i );
		if( defined( 'NV_IS_MODADMIN' ) )
		{
			$xtpl->assign( 'ADMINLINK', nv_link_edit_page( $array_row_i['id'] ) . '&nbsp;-&nbsp;' . nv_link_delete_page( $array_row_i['id'] ) );
			$xtpl->parse( 'main.viewcatloop.adminlink' );
		}
		if( $array_row_i['imghome'] != '' )
		{
			$xtpl->assign( 'HOMEIMG1', $array_row_i['imghome'] );
			$xtpl->assign( 'HOMEIMGALT1', ! empty( $array_row_i['homeimgalt'] ) ? $array_row_i['homeimgalt'] : $array_row_i['title'] );
			$xtpl->parse( 'main.viewcatloop.image' );
		}
		$xtpl->set_autoreset();
		$xtpl->parse( 'main.viewcatloop' );
	}
	if( ! empty( $generate_page ) )
	{
		$xtpl->assign( 'GENERATE_PAGE', $generate_page );
		$xtpl->parse( 'main.generate_page' );
	}
	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * viewcat_page_new()
 *
 * @param mixed $array_catpage
 * @param mixed $array_cat_other
 * @param mixed $generate_page
 * @return
 */
function viewcat_page_new( $array_catpage, $array_cat_other, $generate_page )
{
	global $module_name, $module_file, $lang_module, $module_config, $module_info, $global_array_cat, $catid, $page;
	$xtpl = new XTemplate( 'viewcat_page.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'IMGWIDTH1', $module_config[$module_name]['homewidth'] );
	if( ($global_array_cat[$catid]['viewdescription'] AND $page == 1) OR $global_array_cat[$catid]['viewdescription'] == 2 )
	{
		$xtpl->assign( 'CONTENT', $global_array_cat[$catid] );
		if( $global_array_cat[$catid]['image'] )
		{
			$xtpl->assign( 'HOMEIMG1', NV_BASE_SITEURL . NV_FILES_DIR . '/' . $module_name . '/' . $global_array_cat[$catid]['image'] );
			$xtpl->parse( 'main.viewdescription.image' );
		}
		$xtpl->parse( 'main.viewdescription' );
	}
	$a = 0;
	foreach( $array_catpage as $array_row_i )
	{
		$array_row_i['publtime'] = nv_date( 'd/m/Y h:i:s A', $array_row_i['publtime'] );
		$xtpl->clear_autoreset();
		$xtpl->assign( 'CONTENT', $array_row_i );
		if( defined( 'NV_IS_MODADMIN' ) )
		{
			$xtpl->assign( 'ADMINLINK', nv_link_edit_page( $array_row_i['id'] ) . '&nbsp;-&nbsp;' . nv_link_delete_page( $array_row_i['id'] ) );
			$xtpl->parse( 'main.viewcatloop.adminlink' );
		}
		if( $array_row_i['imghome'] != '' )
		{
			$xtpl->assign( 'HOMEIMG1', $array_row_i['imghome'] );
			$xtpl->assign( 'HOMEIMGALT1', ! empty( $array_row_i['homeimgalt'] ) ? $array_row_i['homeimgalt'] : $array_row_i['title'] );
			$xtpl->parse( 'main.viewcatloop.image' );
		}
		$xtpl->set_autoreset();
		$xtpl->parse( 'main.viewcatloop' );
		++$a;
	}
	if( ! empty( $array_cat_other ) )
	{
		$xtpl->assign( 'ORTHERNEWS', $lang_module['other'] );
		foreach( $array_cat_other as $array_row_i )
		{
			$array_row_i['publtime'] = nv_date( 'd/m/Y', $array_row_i['publtime'] );
			$xtpl->assign( 'RELATED', $array_row_i );
			$xtpl->parse( 'main.related.loop' );
		}
		$xtpl->parse( 'main.related' );
	}
	if( ! empty( $generate_page ) )
	{
		$xtpl->assign( 'GENERATE_PAGE', $generate_page );
		$xtpl->parse( 'main.generate_page' );
	}
	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * viewcat_top()
 *
 * @param mixed $array_catcontent
 * @param mixed $generate_page
 * @return
 */
function viewcat_top( $array_catcontent, $generate_page )
{
	global $module_name, $module_file, $lang_module, $module_config, $module_info, $global_array_cat, $catid, $page;
	$xtpl = new XTemplate( 'viewcat_top.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'IMGWIDTH0', $module_config[$module_name]['homewidth'] );
	if( ($global_array_cat[$catid]['viewdescription'] AND $page == 1) OR $global_array_cat[$catid]['viewdescription'] == 2 )
	{
		$xtpl->assign( 'CONTENT', $global_array_cat[$catid] );
		if( $global_array_cat[$catid]['image'] )
		{
			$xtpl->assign( 'HOMEIMG1', NV_BASE_SITEURL . NV_FILES_DIR . '/' . $module_name . '/' . $global_array_cat[$catid]['image'] );
			$xtpl->parse( 'main.viewdescription.image' );
		}
		$xtpl->parse( 'main.viewdescription' );
	}
	// Cac bai viet phan dau
	if( ! empty( $array_catcontent ) )
	{
		foreach( $array_catcontent as $key => $array_catcontent_i )
		{
			$array_catcontent_i['publtime'] = nv_date( 'd/m/Y h:i:s A', $array_catcontent_i['publtime'] );
			$xtpl->assign( 'CONTENT', $array_catcontent_i );
			if( $key == 0 )
			{
				if( $array_catcontent_i['imghome'] != '' )
				{
					$xtpl->assign( 'HOMEIMG0', $array_catcontent_i['imghome'] );
					$xtpl->assign( 'HOMEIMGALT0', $array_catcontent_i['homeimgalt'] );
					$xtpl->parse( 'main.catcontent.image' );
				}
				if( defined( 'NV_IS_MODADMIN' ) )
				{
					$xtpl->assign( 'ADMINLINK', nv_link_edit_page( $array_catcontent_i['id'] ) . '&nbsp;-&nbsp;' . nv_link_delete_page( $array_catcontent_i['id'] ) );
					$xtpl->parse( 'main.catcontent.adminlink' );
				}
				$xtpl->parse( 'main.catcontent' );
			}
			else
			{
				$xtpl->parse( 'main.catcontentloop' );
			}
		}
	}
	// Het cac bai viet phan dau
	if( ! empty( $generate_page ) )
	{
		$xtpl->assign( 'GENERATE_PAGE', $generate_page );
		$xtpl->parse( 'main.generate_page' );
	}
	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * viewsubcat_main()
 *
 * @param mixed $viewcat
 * @param mixed $array_cat
 * @return
 */
function viewsubcat_main( $viewcat, $array_cat )
{
	global $module_name, $module_file, $global_array_cat, $lang_module, $module_config, $module_info;
	$xtpl = new XTemplate( $viewcat . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	// Hien thi cac chu de con
	foreach( $array_cat as $key => $array_row_i )
	{
		if( isset( $array_cat[$key]['content'] ) )
		{
			$xtpl->assign( 'CAT', $array_row_i );
			$catid = intval( $array_row_i['catid'] );
			if( $array_row_i['subcatid'] != '' )
			{
				$exl = 0;
				$arrsubcat_s = explode( ',', $array_row_i['subcatid'] );
				foreach( $arrsubcat_s as $subcatid_i )
				{
					if( $global_array_cat[$subcatid_i]['inhome'] == 1 )
					{
						$xtpl->clear_autoreset();
						if( $exl < 3 )
						{
							$xtpl->assign( 'SUBCAT', $global_array_cat[$subcatid_i] );
							$xtpl->parse( 'main.listcat.subcatloop' );
							$xtpl->set_autoreset();
						}
						else
						{
							$more = array( 'title' => $lang_module['more'], 'link' => $global_array_cat[$catid]['link'] );
							$xtpl->assign( 'MORE', $more );
							$xtpl->parse( 'main.listcat.subcatmore' );
							$xtpl->set_autoreset();
							break;
						}
						++$exl;
					}
				}
			}

			$a = 0;
			$xtpl->assign( 'IMGWIDTH', $module_config[$module_name]['homewidth'] );
			foreach( $array_cat[$key]['content'] as $array_row_i )
			{
				$array_row_i['publtime'] = nv_date( 'd/m/Y h:i:s A', $array_row_i['publtime'] );
				++$a;
				if( $a == 1 )
				{
					$xtpl->assign( 'CONTENT', $array_row_i );
					if( $array_row_i['imghome'] != '' )
					{
						$xtpl->assign( 'HOMEIMG', $array_row_i['imghome'] );
						$xtpl->assign( 'HOMEIMGALT', ! empty( $array_row_i['homeimgalt'] ) ? $array_row_i['homeimgalt'] : $array_row_i['title'] );
						$xtpl->parse( 'main.listcat.image' );
					}
					if( defined( 'NV_IS_MODADMIN' ) )
					{
						$xtpl->assign( 'ADMINLINK', nv_link_edit_page( $array_row_i['id'] ) . '&nbsp;-&nbsp;' . nv_link_delete_page( $array_row_i['id'] ) );
						$xtpl->parse( 'main.listcat.adminlink' );
					}
				}
				else
				{
					$xtpl->assign( 'OTHER', $array_row_i );
					$xtpl->parse( 'main.listcat.related.loop' );
				}
				if( $a > 1 )
				{
					if( $viewcat == 'viewcat_main_right' )
					{
						$xtpl->assign( 'BORDER', 'border_r ' );
					}
					elseif( $viewcat == 'viewcat_main_left' )
					{
						$xtpl->assign( 'BORDER', 'border_l ' );
					}
					else
					{
						$xtpl->assign( 'BORDER', 'border_b ' );
					}
					$xtpl->assign( 'WCT', 'fixedwidth ' );
				}
				else
				{
					$xtpl->assign( 'WCT', 'fullwidth noborder ' );
				}
				$xtpl->set_autoreset();
			}
			if( $a > 1 )
			{
				$xtpl->parse( 'main.listcat.related' );
			}
			$xtpl->parse( 'main.listcat' );
		}
	}
	// het Hien thi cac chu de con
	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * viewcat_two_column()
 *
 * @param mixed $array_content
 * @param mixed $array_catpage
 * @return
 */
function viewcat_two_column( $array_content, $array_catpage )
{
	global $module_name, $module_file, $module_config, $module_info, $lang_module, $global_array_cat, $catid, $page;
	$xtpl = new XTemplate( 'viewcat_two_column.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );

	$xtpl->assign( 'IMGWIDTH0', $module_config[$module_name]['homewidth'] );
	if( ($global_array_cat[$catid]['viewdescription'] AND $page == 1) OR $global_array_cat[$catid]['viewdescription'] == 2 )
	{
		$xtpl->assign( 'CONTENT', $global_array_cat[$catid] );
		if( $global_array_cat[$catid]['image'] )
		{
			$xtpl->assign( 'HOMEIMG1', NV_BASE_SITEURL . NV_FILES_DIR . '/' . $module_name . '/' . $global_array_cat[$catid]['image'] );
			$xtpl->parse( 'main.viewdescription.image' );
		}
		$xtpl->parse( 'main.viewdescription' );
	}

	//Bai viet o phan dau
	if( ! empty( $array_content ) )
	{
		foreach( $array_content as $key => $array_content_i )
		{
			$xtpl->assign( 'NEWSTOP', $array_content_i );
			if( $key == 0 )
			{
				if( $array_content_i['imghome'] != '' )
				{
					$xtpl->assign( 'HOMEIMG0', $array_content_i['imghome'] );
					$xtpl->assign( 'HOMEIMGALT0', $array_content_i['homeimgalt'] );
					$xtpl->parse( 'main.catcontent.content.image' );
				}
				if( defined( 'NV_IS_MODADMIN' ) )
				{
					$xtpl->assign( 'ADMINLINK', nv_link_edit_page( $array_content_i['id'] ) . '&nbsp;-&nbsp;' . nv_link_delete_page( $array_content_i['id'] ) );
					$xtpl->parse( 'main.catcontent.content.adminlink' );
				}
				$xtpl->parse( 'main.catcontent.content' );
			}
			else
			{
				$xtpl->parse( 'main.catcontent.other' );
			}
		}
		$xtpl->parse( 'main.catcontent' );
	}
	//Het Bai viet o phan dau

	//Theo chu de
	$a = 0;
	$xtpl->assign( 'IMGWIDTH01', $module_config[$module_name]['homewidth'] );

	foreach( $array_catpage as $key => $array_catpage_i )
	{
		$number_content = isset( $array_catpage[$key]['content'] ) ? sizeof( $array_catpage[$key]['content'] ) : 0;
		if( $number_content > 0 )
		{
			$xtpl->assign( 'CAT', $array_catpage_i );
			$xtpl->assign( 'ID', $a );
			$xtpl->assign( 'LAST', $a % 2 ? ' last' : '' );
			$xtpl->assign( 'BORDER', $number_content > 1 ? ' border_b' : '' );
			$k = 0;
			$array_content_i = $array_catpage_i['content'][0];
			$array_content_i['hometext'] = nv_clean60( $array_content_i['hometext'], 300 );
			$xtpl->assign( 'CONTENT', $array_content_i );
			if( $array_content_i['imghome'] != '' )
			{
				$xtpl->assign( 'HOMEIMG01', $array_content_i['imghome'] );
				$xtpl->assign( 'HOMEIMGALT01', ! empty( $array_content_i['homeimgalt'] ) ? $array_content_i['homeimgalt'] : $array_content_i['title'] );
				$xtpl->parse( 'main.loopcat.content.image' );
			}
			if( defined( 'NV_IS_MODADMIN' ) )
			{
				$xtpl->assign( 'ADMINLINK', nv_link_edit_page( $array_content_i['id'] ) . '&nbsp;-&nbsp;' . nv_link_delete_page( $array_content_i['id'] ) );
				$xtpl->parse( 'main.loopcat.content.adminlink' );
			}
			$xtpl->parse( 'main.loopcat.content' );
			if( $number_content > 1 )
			{
				for( $index = 1; $index < $number_content; ++$index )
				{
					$xtpl->assign( 'CONTENT', $array_catpage_i['content'][$index] );
					$xtpl->parse( 'main.loopcat.other' );
				}
			}
			if( $a % 2 )
			{
				$xtpl->parse( 'main.loopcat.clear' );
			}
			$xtpl->parse( 'main.loopcat' );
			++$a;
		}
	}
	//Theo chu de
	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * detail_theme()
 *
 * @param mixed $news_contents
 * @param mixed $related_new_array
 * @param mixed $related_array
 * @param mixed $topic_array
 * @param mixed $commentenable
 * @return
 */
function detail_theme( $news_contents, $array_keyword, $related_new_array, $related_array, $topic_array, $commentenable )
{
	global $module_info, $lang_module, $module_name, $module_file, $module_config, $my_head, $lang_global, $user_info, $admin_info, $client_info;

	$my_head .= "<script type=\"text/javascript\" src=\"" . NV_BASE_SITEURL . "js/star-rating/jquery.rating.pack.js\"></script>\n";
	$my_head .= "<script src=\"" . NV_BASE_SITEURL . "js/star-rating/jquery.MetaData.js\" type=\"text/javascript\"></script>\n";
	$my_head .= "<link href=\"" . NV_BASE_SITEURL . "js/star-rating/jquery.rating.css\" type=\"text/css\" rel=\"stylesheet\"/>\n";

	if( ! defined( 'SHADOWBOX' ) )
	{
		$my_head .= "<link type=\"text/css\" rel=\"Stylesheet\" href=\"" . NV_BASE_SITEURL . "js/shadowbox/shadowbox.css\" />\n";
		$my_head .= "<script type=\"text/javascript\" src=\"" . NV_BASE_SITEURL . "js/shadowbox/shadowbox.js\"></script>\n";
		$my_head .= "<script type=\"text/javascript\">Shadowbox.init({ handleOversize: \"drag\" });</script>";
		define( 'SHADOWBOX', true );
	}

	$xtpl = new XTemplate( 'detail.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$news_contents['addtime'] = nv_date( 'd/m/Y h:i:s', $news_contents['addtime'] );
	$xtpl->assign( 'NEWSID', $news_contents['id'] );
	$xtpl->assign( 'NEWSCHECKSS', $news_contents['newscheckss'] );
	$xtpl->assign( 'DETAIL', $news_contents );
	$xtpl->assign( 'SELFURL', $client_info['selfurl'] );

	if( $news_contents['allowed_send'] == 1 )
	{
		$xtpl->assign( 'URL_SENDMAIL', $news_contents['url_sendmail'] );
		$xtpl->parse( 'main.allowed_send' );
	}
	if( $news_contents['allowed_print'] == 1 )
	{
		$xtpl->assign( 'URL_PRINT', $news_contents['url_print'] );
		$xtpl->parse( 'main.allowed_print' );
	}
	if( $news_contents['allowed_save'] == 1 )
	{
		$xtpl->assign( 'URL_SAVEFILE', $news_contents['url_savefile'] );
		$xtpl->parse( 'main.allowed_save' );
	}
	if( $news_contents['allowed_rating'] == 1 )
	{
		$xtpl->assign( 'LANGSTAR', $news_contents['langstar'] );
		$xtpl->assign( 'STRINGRATING', $news_contents['stringrating'] );
		$xtpl->assign( 'NUMBERRATING', $news_contents['numberrating'] );

		if( $news_contents['disablerating'] == 1 )
		{
			$xtpl->parse( 'main.allowed_rating.disablerating' );
		}

		if( $news_contents['numberrating'] >= $module_config[$module_name]['allowed_rating_point'] )
		{
			$xtpl->parse( 'main.allowed_rating.data_rating' );
		}

		$xtpl->parse( 'main.allowed_rating' );
	}

	if( $module_config[$module_name]['socialbutton'] OR ( $module_config[$module_name]['activecomm'] == 2 AND $commentenable > 0 ) )
	{
		global $meta_property;
		$meta_property['fb:app_id'] = $module_config[$module_name]['facebookappid'];
		$xtpl->assign( 'FACEBOOKAPPID', $module_config[$module_name]['facebookappid'] );
		$xtpl->parse( 'main.facebookjssdk' );
	}

	if( $module_config[$module_name]['socialbutton'] )
	{
		$xtpl->parse( 'main.socialbutton' );
	}

	if( $news_contents['showhometext'] )
	{
		if( ! empty( $news_contents['image']['src'] ) )
		{
			if( $news_contents['image']['position'] == 1 )
			{
				$xtpl->parse( 'main.showhometext.imgthumb' );
			}
			elseif( $news_contents['image']['position'] == 2 )
			{
				$xtpl->parse( 'main.showhometext.imgfull' );
			}
		}
		$xtpl->parse( 'main.showhometext' );
	}

	if( ! empty( $news_contents['author'] ) or ! empty( $news_contents['source'] ) )
	{
		if( ! empty( $news_contents['author'] ) )
		{
			$xtpl->parse( 'main.author.name' );
		}
		if( ! empty( $news_contents['source'] ) )
		{
			$xtpl->parse( 'main.author.source' );
		}
		$xtpl->parse( 'main.author' );
	}
	if( $news_contents['copyright'] == 1 )
	{
		if( ! empty( $module_config[$module_name]['copyright'] ) )
		{
			$xtpl->assign( 'COPYRIGHT', $module_config[$module_name]['copyright'] );
			$xtpl->parse( 'main.copyright' );
		}
	}

	if( ! empty( $array_keyword ) )
	{
		$t = sizeof( $array_keyword ) - 1;
		foreach( $array_keyword as $i => $value )
		{
			$xtpl->assign( 'KEYWORD', $value['keyword'] );
			$xtpl->assign( 'LINK_KEYWORDS', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=tag/' . urlencode( $value['alias'] ) );
			$xtpl->assign( 'SLASH', ($t == $i) ? '' : ', ' );
			$xtpl->parse( 'main.keywords.loop' );
		}
		$xtpl->parse( 'main.keywords' );
	}

	if( defined( 'NV_IS_MODADMIN' ) )
	{
		$xtpl->assign( 'ADMINLINK', nv_link_edit_page( $news_contents['id'] ) . '&nbsp;-&nbsp;' . nv_link_delete_page( $news_contents['id'] ) );
		$xtpl->parse( 'main.adminlink' );
	}

	if( $module_config[$module_name]['activecomm'] == 1 )
	{
		$xtpl->assign( 'COMMENTCONTENT', $news_contents['comment'] );
		$xtpl->assign( 'IMGSHOWCOMMENT', NV_BASE_SITEURL . 'themes/' . $module_info['template'] . '/images/' . $module_file . '/comment.png' );
		$xtpl->assign( 'IMGADDCOMMENT', NV_BASE_SITEURL . 'themes/' . $module_info['template'] . '/images/' . $module_file . '/comment_add.png' );
		if( $commentenable == 1 )
		{
			if( defined( 'NV_IS_ADMIN' ) )
			{
				$xtpl->assign( 'NAME', $admin_info['full_name'] );
				$xtpl->assign( 'EMAIL', $admin_info['email'] );
				$xtpl->assign( 'DISABLED', ' disabled=\'disabled\'' );
			}
			elseif( defined( 'NV_IS_USER' ) )
			{
				$xtpl->assign( 'NAME', $user_info['full_name'] );
				$xtpl->assign( 'EMAIL', $user_info['email'] );
				$xtpl->assign( 'DISABLED', ' disabled=\'disabled\'' );
			}
			else
			{
				$xtpl->assign( 'NAME', '' );
				$xtpl->assign( 'EMAIL', '' );
				$xtpl->assign( 'DISABLED', '' );
			}
			$xtpl->assign( 'N_CAPTCHA', $lang_global['securitycode'] );
			$xtpl->assign( 'CAPTCHA_REFRESH', $lang_global['captcharefresh'] );
			$xtpl->assign( 'GFX_NUM', NV_GFX_NUM );
			$xtpl->assign( 'GFX_WIDTH', NV_GFX_WIDTH );
			$xtpl->assign( 'GFX_WIDTH', NV_GFX_WIDTH );
			$xtpl->assign( 'GFX_HEIGHT', NV_GFX_HEIGHT );
			$xtpl->assign( 'CAPTCHA_REFR_SRC', NV_BASE_SITEURL . 'images/refresh.png' );
			$xtpl->assign( 'SRC_CAPTCHA', NV_BASE_SITEURL . 'index.php?scaptcha=captcha' );
			$xtpl->parse( 'main.comment.form' );
		}
		elseif( $commentenable == 2 )
		{
			$link_login = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=users&amp;' . NV_OP_VARIABLE . '=login&amp;nv_redirect=' . nv_base64_encode( $client_info['selfurl'] . '#formcomment' );
			$xtpl->assign( 'COMMENT_LOGIN', '<a title=\'' . $lang_global['loginsubmit'] . '\' href=\'' . $link_login . '\'>' . $lang_module['comment_login'] . '</a>' );
			$xtpl->parse( 'main.comment.form_login' );
		}

		$xtpl->parse( 'main.comment' );
	}
	elseif( $module_config[$module_name]['activecomm'] == 2 AND $commentenable > 0 )
	{
		$xtpl->parse( 'main.commentfacebook' );
	}

	if( ! empty( $related_new_array ) )
	{
		foreach( $related_new_array as $key => $related_new_array_i )
		{
			$xtpl->assign( 'RELATED_NEW', $related_new_array_i );
			$xtpl->parse( 'main.related_new.loop' );
		}
		unset( $key );
		$xtpl->parse( 'main.related_new' );
	}

	if( ! empty( $related_array ) )
	{
		foreach( $related_array as $related_array_i )
		{
			$xtpl->assign( 'RELATED', $related_array_i );
			$xtpl->parse( 'main.related.loop' );
		}
		$xtpl->parse( 'main.related' );
	}
	if( ! empty( $topic_array ) )
	{
		foreach( $topic_array as $key => $topic_array_i )
		{
			$xtpl->assign( 'TOPIC', $topic_array_i );
			$xtpl->parse( 'main.topic.loop' );
		}
		$xtpl->parse( 'main.topic' );
	}
	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * no_permission()
 *
 * @param mixed $func_who_view
 * @return
 */
function no_permission( $func_who_view )
{
	global $module_info, $module_file, $lang_module;
	$xtpl = new XTemplate( 'detail.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	if( $func_who_view == 1 )
	{
		$no_permission = $lang_module['member_view'];
	}
	elseif( $func_who_view == 2 )
	{
		$no_permission = $lang_module['admin_view'];
	}
	elseif( $func_who_view == 3 )
	{
		$no_permission = $lang_module['group_view'];
	}
	$xtpl->assign( 'NO_PERMISSION', $no_permission );
	$xtpl->parse( 'no_permission' );
	return $xtpl->text( 'no_permission' );
}

/**
 * topic_theme()
 *
 * @param mixed $topic_array
 * @param mixed $topic_other_array
 * @param mixed $generate_page
 * @return
 */
function topic_theme( $topic_array, $topic_other_array, $generate_page, $page_title, $description, $topic_image )
{
	global $module_info, $module_name, $module_file, $topicalias, $module_config;
	$xtpl = new XTemplate( 'topic.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'TOPPIC_TITLE', $page_title );
	$xtpl->assign( 'IMGWIDTH1', $module_config[$module_name]['homewidth'] );
	if( ! empty( $description ) )
	{
		$xtpl->assign( 'TOPPIC_DESCRIPTION', $description );
		if(!empty($topic_image))
		{
			$xtpl->assign( 'HOMEIMG1', $topic_image );
			$xtpl->parse( 'main.topicdescription.image' );
		}
		$xtpl->parse( 'main.topicdescription' );
	}
	if( ! empty( $topic_array ) )
	{
		foreach( $topic_array as $topic_array_i )
		{
			$xtpl->assign( 'TOPIC', $topic_array_i );
			$xtpl->assign( 'TIME', date( 'H:i', $topic_array_i['publtime'] ) );
			$xtpl->assign( 'DATE', date( 'd/m/Y', $topic_array_i['publtime'] ) );
			if( ! empty( $topic_array_i['src'] ) )
			{
				$xtpl->parse( 'main.topic.homethumb' );
			}
			if( defined( 'NV_IS_MODADMIN' ) )
			{
				$xtpl->assign( 'ADMINLINK', nv_link_edit_page( $topic_array_i['id'] ) . '&nbsp;-&nbsp;' . nv_link_delete_page( $topic_array_i['id'] ) );
				$xtpl->parse( 'main.topic.adminlink' );
			}

			$xtpl->parse( 'main.topic' );
		}
	}
	if( ! empty( $topic_other_array ) )
	{
		foreach( $topic_other_array as $topic_other_array_i )
		{
			$xtpl->assign( 'TOPIC_OTHER', $topic_other_array_i );
			$xtpl->parse( 'main.other.loop' );
		}
		$xtpl->parse( 'main.other' );
	}
	if( ! empty( $generate_page ) )
	{
		$xtpl->assign( 'GENERATE_PAGE', $generate_page );
		$xtpl->parse( 'main.generate_page' );
	}
	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * comment_theme()
 *
 * @param mixed $comment_array
 * @return
 */
function comment_theme( $comment_array )
{
	global $module_info, $module_name, $module_file, $module_config;
	$xtpl = new XTemplate( 'comment.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$k = 0;
	foreach( $comment_array['comment'] as $comment_array_i )
	{
		$comment_array_i['post_time'] = nv_date( 'd/m/Y H:i', $comment_array_i['post_time'] );
		$comment_array_i['bg'] = ( $k % 2 ) ? ' bg' : '';
		$xtpl->assign( 'COMMENT', $comment_array_i );
		if( $module_config[$module_name]['emailcomm'] and ! empty( $comment_array_i['post_email'] ) )
		{
			$xtpl->parse( 'main.detail.emailcomm' );
		}
		$xtpl->parse( 'main.detail' );
		++$k;
	}
	if( ! empty( $comment_array['page'] ) )
	{
		$xtpl->assign( 'PAGE', $comment_array['page'] );
	}
	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * sendmail_themme()
 *
 * @param mixed $sendmail
 * @return
 */
function sendmail_themme( $sendmail )
{
	global $module_info, $module_file, $global_config, $lang_module, $lang_global;
	$script = nv_html_site_js();
	$script .= "<script type=\"text/javascript\" src=\"" . NV_BASE_SITEURL . "js/jquery/jquery.validate.min.js\"></script>\n";
	$script .= "<script type=\"text/javascript\" src=\"" . NV_BASE_SITEURL . "js/language/jquery.validator-" . NV_LANG_INTERFACE . ".js\"></script>\n";

	$script .= "<script type=\"text/javascript\">\n";
	$script .= " $(document).ready(function(){\n";
	$script .= " $(\"#sendmailForm\").validate();\n";
	$script .= " });\n";
	$script .= "</script>\n";

	$sendmail['script'] = $script;
	$xtpl = new XTemplate( 'sendmail.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'SENDMAIL', $sendmail );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
	$xtpl->assign( 'GFX_NUM', NV_GFX_NUM );
	if( $global_config['gfx_chk'] > 0 )
	{
		$xtpl->assign( 'CAPTCHA_REFRESH', $lang_global['captcharefresh'] );
		$xtpl->assign( 'CAPTCHA_REFR_SRC', NV_BASE_SITEURL . 'images/refresh.png' );
		$xtpl->assign( 'N_CAPTCHA', $lang_global['securitycode'] );
		$xtpl->assign( 'GFX_WIDTH', NV_GFX_WIDTH );
		$xtpl->assign( 'GFX_HEIGHT', NV_GFX_HEIGHT );
		$xtpl->parse( 'main.content.captcha' );
	}
	$xtpl->parse( 'main.content' );
	if( ! empty( $sendmail['result'] ) )
	{
		$xtpl->assign( 'RESULT', $sendmail['result'] );
		$xtpl->parse( 'main.result' );
		if( $sendmail['result']['check'] == true )
		{
			$xtpl->parse( 'main.close' );
		}
	}
	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * news_print()
 *
 * @param mixed $result
 * @return
 */
function news_print( $result )
{
	global $module_info, $module_file, $lang_module;
	$xtpl = new XTemplate( 'print.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'CONTENT', $result );
	$xtpl->assign( 'LANG', $lang_module );
	if( ! empty( $result['image']['width'] ) )
	{
		if( $result['image']['position'] == 1 )
		{
			if( ! empty( $result['image']['note'] ) )
			{
				$xtpl->parse( 'main.image.note' );
			}
			$xtpl->parse( 'main.image' );
		}
		elseif( $result['image']['position'] == 2 )
		{
			if( $result['image']['note'] > 0 )
			{
				$xtpl->parse( 'main.imagefull.note' );
			}
			$xtpl->parse( 'main.imagefull' );
		}
	}
	if( $result['copyright'] == 1 )
	{
		$xtpl->parse( 'main.copyright' );
	}
	if( ! empty( $result['author'] ) or ! empty( $result['source'] ) )
	{
		if( ! empty( $result['author'] ) )
		{
			$xtpl->parse( 'main.author.name' );
		}
		if( ! empty( $result['source'] ) )
		{
			$xtpl->parse( 'main.author.source' );
		}
		$xtpl->parse( 'main.author' );
	}
	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * search_theme()
 *
 * @param mixed $key
 * @param mixed $check_num
 * @param mixed $date_array
 * @param mixed $array_cat_search
 * @return
 */
function search_theme( $key, $check_num, $date_array, $array_cat_search )
{
	global $module_name, $module_info, $module_file, $lang_module, $module_name;
	$xtpl = new XTemplate( 'search.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$base_url_site = NV_BASE_SITEURL . '?';
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'NV_LANG_VARIABLE', NV_LANG_VARIABLE );
	$xtpl->assign( 'NV_LANG_DATA', NV_LANG_DATA );
	$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
	$xtpl->assign( 'MODULE_NAME', $module_name );
	$xtpl->assign( 'BASE_URL_SITE', $base_url_site );
	$xtpl->assign( 'TO_DATE', $date_array['to_date'] );
	$xtpl->assign( 'FROM_DATE', $date_array['from_date'] );
	$xtpl->assign( 'KEY', $key );
	$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
	$xtpl->assign( 'OP_NAME', 'search' );
	foreach( $array_cat_search as $search_cat )
	{
		$xtpl->assign( 'SEARCH_CAT', $search_cat );
		$xtpl->parse( 'main.search_cat' );
	}
	for( $i = 0; $i <= 3; ++$i )
	{
		if( $check_num == $i ) $xtpl->assign( 'CHECK' . $i, 'selected=\'selected\'' );
		else $xtpl->assign( 'CHECK' . $i, '' );
	}
	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * search_result_theme()
 *
 * @param mixed $key
 * @param mixed $numRecord
 * @param mixed $per_pages
 * @param mixed $pages
 * @param mixed $array_content
 * @param mixed $url_link
 * @param mixed $catid
 * @return
 */
function search_result_theme( $key, $numRecord, $per_pages, $pages, $array_content, $url_link, $catid )
{
	global $module_file, $module_info, $lang_module, $module_name, $global_array_cat, $module_config;
	$xtpl = new XTemplate( 'search.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );

	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'KEY', $key );
	$xtpl->assign( 'IMG_WIDTH', $module_config[$module_name]['homewidth'] );

	$xtpl->assign( 'TITLE_MOD', $lang_module['search_modul_title'] );

	if( ! empty( $array_content ) )
	{
		foreach( $array_content as $value )
		{
			$catid_i = $value['catid'];
			$url = $global_array_cat[$catid_i]['link'] . '/' . $value['alias'] . '-' . $value['id'];
			$xtpl->assign( 'LINK', $url );
			$xtpl->assign( 'TITLEROW', BoldKeywordInStr( $value['title'], $key ) );
			$xtpl->assign( 'CONTENT', BoldKeywordInStr( $value['hometext'], $key ) . '...' );
			$xtpl->assign( 'AUTHOR', date( 'd/m/Y', $value['publtime'] ) . ' - ' . BoldKeywordInStr( $value['author'], $key ) );
			$xtpl->assign( 'SOURCE', BoldKeywordInStr( GetSourceNews( $value['sourceid'] ), $key ) );
			if( ! empty( $value['homeimgfile'] ) )
			{
				$xtpl->assign( 'IMG_SRC', $value['homeimgfile'] );
				$xtpl->parse( 'results.result.result_img' );
			}
			$xtpl->parse( 'results.result' );
		}
	}
	if( $numRecord == 0 )
	{
		$xtpl->assign( 'KEY', $key );
		$xtpl->assign( 'INMOD', $lang_module['search_modul_title'] );
		$xtpl->parse( 'results.noneresult' );
	}
	if( $numRecord > $per_pages ) // show pages
	{
		$url_link = $_SERVER['REQUEST_URI'];
		$in = strpos( $url_link, '&page' );
		if( $in != 0 ) $url_link = substr( $url_link, 0, $in );
		$generate_page = nv_generate_page( $url_link, $numRecord, $per_pages, $pages );
		$xtpl->assign( 'VIEW_PAGES', $generate_page );
		$xtpl->parse( 'results.pages_result' );
	}
	$xtpl->assign( 'MY_DOMAIN', NV_MY_DOMAIN );
	$xtpl->assign( 'NUMRECORD', $numRecord );
	$xtpl->parse( 'results' );
	return $xtpl->text( 'results' );
}

?>