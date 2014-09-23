<?php
/**
 * @Project NUKEVIET 3.0
 * @Author VINADES., JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES ., JSC. All rights reserved
 * @Createdate Dec 3, 2010  11:32:04 AM 
 */

if ( ! defined( 'NV_IS_MOD_ORGAN' ) ) die( 'Stop!!!' );

$key_words = $module_info['keywords'];

//get pages
$pid = 0;
if ( ! empty( $array_op[2] ) )
{
    $temp = explode( '-', $array_op[2] );
    if ( ! empty( $temp ) )
    {
        $pid = end( $temp );
    }
}
//get id
$oid = 0;
if ( ! empty( $array_op[1] ) )
{
    $temp = explode( '-', $array_op[1] );
    if ( ! empty( $temp ) )
    {
        $oid = end( $temp );
    }
}

$data_content = array();
$sql = "SELECT * FROM `" . NV_PREFIXLANG . "_" . $module_data . "_person` WHERE personid=" . intval( $pid ) . " AND `active`=1";
$result = $db->sql_query( $sql );
$data_content = $db->sql_fetchrow( $result, 2 );

if ( empty( $data_content ) )
{
    $redirect = "<meta http-equiv=\"Refresh\" content=\"3;URL=" . nv_url_rewrite( NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name, true ) . "\" />";
    nv_info_die( $lang_global['error_404_title'], $lang_global['error_404_title'], $lang_global['error_404_content'] . $redirect );
}

if ( ! empty( $data_content['photo'] ) )
{
    $urlimg = NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $module_name . '/' . $data_content['photo'];
    $data_content['imgsrc'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_name . '/' . $data_content['photo'];
    $imageinfo = nv_ImageInfo( $urlimg, 200, true, NV_UPLOADS_REAL_DIR . '/' . $module_name . '/thumb' );
    $data_content['photo'] = $imageinfo['src'];
}

$page_title = $data_content['name'];
$contents = detail_per( $data_content );

include ( NV_ROOTDIR . "/includes/header.php" );
echo nv_site_theme( $contents );
include ( NV_ROOTDIR . "/includes/footer.php" );

?>