<?php
/*
Plugin Name: JSTooltip 4 Altervista
Plugin URI: http://gerasimone.altervista.org/2009/jstooltip-4-altervista-wordpress-plugin
Description: Aggiunge in modo rapido il supporto ai circuito JSToolTip ai post del vostro blog in hosting presso Altervista, facendovi inoltre scegliere alcune parole per le quali non saranno visualizzate pubblicit&agrave;
Version: 1.1
Author: Simone Gerardiello
Author URI: http://gerasimone.altervista.org

/*  Copyright 2009  Simone Gerardiello

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function add_jsTooltip_gera($content) {
	return "<!-- <EdIndex> --> ".$content." <!-- </EdIndex> -->";
}

function add_jsTooltip_gera_script() {
	echo "<!-- Start Of Script JSTooltip 4 Altervista 1.0 -->
<script type=\"text/javascript\">
//<![CDATA[
document.write('<s'+'cript type=\"text/javascript\" src=\"http://ad.altervista.org/js.ad/size=0X1/r='+new Date().getTime()+'\"><\/s'+'cript>');
//]]>
</script>
	";
}

function add_jsTooltip_gera_header() {
	$jsTooltip_gera_exclude_words = get_option("jsTooltip_gera_exclude_words");
	if($jsTooltip_gera_exclude_words != "")
		echo "<meta name=\"EdStopWord\" content=\"". $jsTooltip_gera_exclude_words ."\">";
}

function jsTooltip_gera_menu() {
  add_options_page(__( 'Configurazione JSToolTip 4 Altervista'), 'JSToolTip4Av', 8, __FILE__, 'jsTooltip_gera_options');
}

function jsTooltip_gera_options() {
    if( $_POST["hidden_save_option"] == 'Y' ) {
        update_option("jsTooltip_gera_exclude_words", trim(htmlentities($_POST["jsTooltip_gera_exclude_words"],ENT_QUOTES)));
?>
		<div class="updated"><p><strong><?php _e('Modifiche salvate.'); ?></strong></p></div>
<?php
    }
	$jsTooltip_gera_exclude_words = get_option("jsTooltip_gera_exclude_words");
?>
<div class="wrap">
<div id="icon-options-general" class="icon32">
<br/>
</div>
<h2><?php _e( 'Configurazione JSToolTip 4 Altervista'); ?> </h2>
<p><strong>Come riporta Altervista </strong>
<i>questo elemento pubblicitario prevede una retribuzione per click variabile a seconda dell'annuncio pubblicitario visualizzato,<br />
le modifiche riportate non sono immediate e possono volerci anche 24 ore.</i><br />
</p>
<form name="form1" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
<input type="hidden" name="hidden_save_option" value="Y">
<br />
<p><strong><?php _e("Blocca pubblicit&agrave; su queste parole:"); ?></strong> <i>(<?php _e("separate da una virgola"); ?>)</i><br />
<textarea name="jsTooltip_gera_exclude_words" cols="90" rows="5"><?php echo $jsTooltip_gera_exclude_words; ?></textarea>
</p><hr />

<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Salva') ?>" />
</p>
</form>
<br />
<p><em>
Per segnalazioni, problemi o semplicemente per ringraziarmi potete utilizzare <a href="http://gerasimone.altervista.org/2009/jstooltip-4-altervista-wordpress-plugin/" target="_blank">questa pagina</a>.</em></p>
</div>

<?php

}


add_filter('the_content', 'add_jsTooltip_gera');
add_action('wp_print_scripts', 'add_jsTooltip_gera_script');
add_action('wp_head', 'add_jsTooltip_gera_header');
add_action('admin_menu', 'jsTooltip_gera_menu');

?>