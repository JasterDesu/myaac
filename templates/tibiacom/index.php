<?php
defined('MYAAC') or die('Direct access not allowed!');

$boostedMonster = getBoostedMonster();
$boostedBoss = getBoostedBoss();

function getStatusText()
{
	global $status;
	if($status['online']){
		echo ' <b>'.$status['players'] . '</b> Players Online <a href="' . getLink('online') . '" title="Players Online "></a></b>';
										   
		}else{
		echo '<font color="red">Server is Offline</font>';
		}
}

if(isset($config['boxes']))
	$config['boxes'] = explode(",", $config['boxes']);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<?php echo template_place_holder('head_start'); ?>
	<link rel="shortcut icon" href="<?=$template_path?>/images/favicon.ico" type="image/x-icon" />
	<link rel="icon" href="<?=$template_path?>/images/favicon.ico" type="image/x-icon">
	<link href="<?=$template_path?>/basic.css" rel="stylesheet" type="text/css" />

	<script type="text/javascript" src="tools/basic.js"></script>
	<script type="text/javascript" src="<?=$template_path?>/ticker.js"></script>
	<script id="twitter-wjs" src="<?=$template_path?>/js/twitter.js"></script>
	<script id="facebook-jssdk" async src="https://connect.facebook.net/en_US/all.js"></script>

	<link href="<?=$template_path?>/css/facebook.css" rel="stylesheet" type="text/css">

	<link rel="stylesheet" href="tools/fonts/fontawesome/all.css">
	<script src="tools/fonts/fontawesome/all.js"></script>

	<script src="admin/bootstrap/jquery-3.6.0.min.js"></script>
	<script src="admin/bootstrap/popper.min.js"></script>
	<script src="admin/bootstrap/js/bootstrap.min.js"></script>
	<link href="admin/bootstrap/bootstrap-lucasg.css" rel="stylesheet" type="text/css">
	
	<link href="<?=$template_path?>/css/smoke.css" rel="stylesheet" type="text/css">

<?php if($config['pace_load'] == true){ ?>
	<script src="admin/bootstrap/pace/pace.js"></script>
	<link href="admin/bootstrap/pace/themes/<?php echo $config['pace_color'] ?>/pace-theme-<?php echo $config['pace_theme'] ?>.css" rel="stylesheet" />
<?php } ?>

	<script>
		function CollapseTable(a_ID)
		{
			$('#' + a_ID).slideToggle('slow');
			if ($('#Indicator_' + a_ID).hasClass('CircleSymbolPlus')) {
				$('#Indicator_' + a_ID).attr('class', 'CircleSymbolMinus');
				$('#Indicator_' + a_ID).css('background-image', 'url(' + IMAGES + '/global/content/circle-symbol-plus.gif)');
			} else {
				$('#Indicator_' + a_ID).css('background-image', 'url(' + IMAGES + '/global/content/circle-symbol-minus.gif)');
				$('#Indicator_' + a_ID).attr('class', 'CircleSymbolPlus');
			}
		}

		var menus = '';
		var loginStatus="<?php echo ($logged ? 'true' : 'false'); ?>";
		<?php
			if(PAGE !== 'news') {
				if(strpos(URI, 'subtopic=') !== false) {
					$tmp = $_REQUEST['subtopic'];
					if($tmp === 'accountmanagement') {
						$tmp = 'accountmanage';
					}
				}
				else {
					$tmp = str_replace('/', '', URI);
					$exp = explode('/', URI);
					if(URI !== 'account/create' && URI !== 'account/lost' && isset($exp[1])) {
						if ($exp[0] === 'account') {
							$tmp = 'accountmanage';
						} else if ($exp[0] === 'news' && $exp[1] === 'archive') {
							$tmp = 'newsarchive';
						}
						else
							$tmp = $exp[0];
					}
				}
			}
			else {
				$tmp = 'news';
			}
		?>
		
		var activeSubmenuItem="<?php echo $tmp; ?>";
		var IMAGES="<?=$template_path?>/images";
		var LINK_ACCOUNT="<?php echo BASE_URL; ?>";

		function rowOverEffect(object) {
			if (object.className == 'moduleRow') object.className = 'moduleRowOver';
		}

		function rowOutEffect(object) {
			if (object.className == 'moduleRowOver') object.className = 'moduleRow';
		}

		function InitializePage() {
		  LoadLoginBox();
		  LoadMenu();
		}

		// initialisation of the loginbox status by the value of the variable 'loginStatus' which is provided to the HTML-document by PHP in the file 'header.inc'
		function LoadLoginBox()
		{
		  if(loginStatus == "false") {
			document.getElementById('ButtonText').style.backgroundImage = "url('" + IMAGES + "/global/buttons/mediumbutton_login.png')";
			document.getElementById('LoginstatusText_2').style.backgroundImage = "url('" + IMAGES + "/loginbox/loginbox-font-create-account.gif')";
			document.getElementById('LoginstatusText_2_1').style.backgroundImage = "url('" + IMAGES + "/loginbox/loginbox-font-create-account.gif')";
			document.getElementById('LoginstatusText_2_2').style.backgroundImage = "url('" + IMAGES + "/loginbox/loginbox-font-create-account-over.gif')";
		  } else {
			document.getElementById('ButtonText').style.backgroundImage = "url('" + IMAGES + "/global/buttons/mediumbutton_myaccount.png')";
			document.getElementById('LoginstatusText_2').style.backgroundImage = "url('" + IMAGES + "/loginbox/loginbox-font-logout.gif')";
			document.getElementById('LoginstatusText_2_1').style.backgroundImage = "url('" + IMAGES + "/loginbox/loginbox-font-logout.gif')";
			document.getElementById('LoginstatusText_2_2').style.backgroundImage = "url('" + IMAGES + "/loginbox/loginbox-font-logout-over.gif')";
		  }
		}

		// mouse-over and click events of the loginbox
		function MouseOverLoginBoxText(source)
		{
		  source.lastChild.style.visibility = "visible";
		  source.firstChild.style.visibility = "hidden";
		}
		function MouseOutLoginBoxText(source)
		{
		  source.firstChild.style.visibility = "visible";
		  source.lastChild.style.visibility = "hidden";
		}
		function LoginButtonAction()
		{
		  if(loginStatus == "false") {
			window.location = "<?php echo getLink('account/manage'); ?>";
		  } else {
			window.location = "<?php echo getLink('account/manage'); ?>";
		  }
		}
		function LoginstatusTextAction(source) {
		  if(loginStatus == "false") {
			window.location = "<?php echo getLink('account/create'); ?>";
		  } else {
			window.location = "<?php echo getLink('account/logout'); ?>";
		  }
		}

		var menu = [];
		menu[0] = {};
		var unloadhelper = false;

		// load the menu and set the active submenu item by using the variable 'activeSubmenuItem'
		function LoadMenu()
		{
		  document.getElementById("submenu_"+activeSubmenuItem).style.color = "white";
		  document.getElementById("ActiveSubmenuItemIcon_"+activeSubmenuItem).style.visibility = "visible";
		  menus = localStorage.getItem('menus');
		  if(menus.lastIndexOf("&") === -1) {
			  menus = "news=1&account=0&community=0&library=0&forum=0<?php if ($config['gifts_system']) { echo '&shops=0'; } ?>&charbazaar=0&";
		  }
		  FillMenuArray();
		  InitializeMenu();
		}

		function SaveMenu()
		{
		  if(unloadhelper == false) {
				SaveMenuArray();
				unloadhelper = true;
		  }
		}

		// store the values of the variable 'self.name' in the array menu
		function FillMenuArray()
		{
			while(menus.length > 0 ){
				var mark1 = menus.indexOf("=");
				var mark2 = menus.indexOf("&");
				var menuItemName = menus.substr(0, mark1);
				menu[0][menuItemName] = menus.substring(mark1 + 1, mark2);
				menus = menus.substr(mark2 + 1, menus.length);
			}
		}

		// hide or show the corresponding submenus
		function InitializeMenu()
		{
		  for(menuItemName in menu[0]) {
				if(menu[0][menuItemName] == "0") {
					if (document.getElementById(menuItemName+"_Submenu")) {
						document.getElementById(menuItemName+"_Submenu").style.visibility = "hidden";
						document.getElementById(menuItemName+"_Submenu").style.display = "none";
						document.getElementById(menuItemName+"_Lights").style.visibility = "visible";
						document.getElementById(menuItemName+"_Extend").style.backgroundImage = "url(" + IMAGES + "/general/plus.gif)";
					}
				} else {
					if (document.getElementById(menuItemName+"_Submenu")) {
						document.getElementById(menuItemName+"_Submenu").style.visibility = "visible";
						document.getElementById(menuItemName+"_Submenu").style.display = "block";
						document.getElementById(menuItemName+"_Lights").style.visibility = "hidden";
						document.getElementById(menuItemName+"_Extend").style.backgroundImage = "url(" + IMAGES + "/general/minus.gif)";
					}
				}
		  }
		}
		
		function SaveMenuArray()
		{
			var stringSlices = "";
			var temp = "";

			for(menuItemName in menu[0]) {
				stringSlices = menuItemName + "=" + menu[0][menuItemName] + "&";
				temp = temp + stringSlices;
			}

			localStorage.setItem('menus', temp);
		}

		// onClick open or close submenus
		function MenuItemAction(sourceId)
		{
		  if(menu[0][sourceId] == 1) {
				CloseMenuItem(sourceId);
		  } else {
				OpenMenuItem(sourceId);
		  }
		}
		function OpenMenuItem(sourceId)
		{
		  menu[0][sourceId] = 1;
		  document.getElementById(sourceId+"_Submenu").style.visibility = "visible";
		  document.getElementById(sourceId+"_Submenu").style.display = "block";
		  document.getElementById(sourceId+"_Lights").style.visibility = "hidden";
		  document.getElementById(sourceId+"_Extend").style.backgroundImage = "url(" + IMAGES + "/general/minus.gif)";
		}
		function CloseMenuItem(sourceId)
		{
		  menu[0][sourceId] = 0;
		  document.getElementById(sourceId+"_Submenu").style.visibility = "hidden";
		  document.getElementById(sourceId+"_Submenu").style.display = "none";
		  document.getElementById(sourceId+"_Lights").style.visibility = "visible";
		  document.getElementById(sourceId+"_Extend").style.backgroundImage = "url(" + IMAGES + "/general/plus.gif)";
		}

		// mouse-over effects of menubuttons and submenuitems
		function MouseOverMenuItem(source) {
				if(source.firstChild.style){
						source.firstChild.style.visibility = "visible";
				}
		}

		function MouseOutMenuItem(source) {
				if(source.firstChild.style){
						source.firstChild.style.visibility = "hidden";
				}
		}

		function MouseOverSubmenuItem(source) {
				if(source.style){
						source.style.backgroundColor = "#14433F";
				}
		}

		function MouseOutSubmenuItem(source) {
				if(source.style){
						source.style.backgroundColor = "#0D2E2B";
				}
		}
		
	</script>
	<?php echo template_place_holder('head_end'); ?>

	<!-- Meta Pixel Code -->
	<script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];
	s.parentNode.insertBefore(t,s)}(window, document,'script',
	'https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '396903619526541');
	fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
	src="https://www.facebook.com/tr?id=396903619526541&ev=PageView&noscript=1"
	/></noscript>
	<!-- End Meta Pixel Code -->
</head>
<!--
<script>
(function ($) {
  $(function () {


    $(window).on('click', function () {
      $('.js-smoke_smoke').toggleClass('js-ag-smoke_toggle');
    });


  });
})(jQuery);
</script>-->
<body onBeforeUnLoad="SaveMenu();" onUnload="SaveMenu();">



	<?php echo template_place_holder('body_start'); ?>
  <div id="top"></div>
  <div id="ArtworkHelper">
    <div id="Bodycontainer">
      <div id="ContentRow">
        <div id="MenuColumn">
			<div id="LeftArtwork">
				<img id="TibiaLogoArtworkTop" style="margin-top:-210px; margin-left:-25px; width:250px; height:250px;" src="<?=$template_path?>/images/header/logo2.png" onClick="window.location = '<?php echo getLink('news')?>';" alt="logoartwork" />
			</div>

  <div id="Loginbox" >
    <div id="LoginTop" style="background-image:url(<?=$template_path?>/images/general/box-top.gif)" ></div>
    <div id="BorderLeft" class="LoginBorder" style="background-image:url(<?=$template_path?>/images/general/chain.gif)" ></div>
    <div id="LoginButtonContainer" style="background-image:url(<?=$template_path?>/images/loginbox/loginbox-textfield-background.gif)" >
      <div id="LoginButton" style="background-image:url(<?=$template_path?>/images/global/buttons/mediumbutton2.gif)" >
        <div onClick="LoginButtonAction();" onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);"><div class="Button" style="background-image:url(<?=$template_path?>/images/global/buttons/mediumbutton-over2.gif)" ></div>
			<?php
          echo '<div id="ButtonText" '.($logged ? '' : 'style="background-image:url('.$template_path.'/images/global/buttons/mediumbutton_login.png)"').'>
			 </div>';
			 ?>
        </div>
      </div>

    </div>

    <div style="clear:both" ></div>

    <div class="Loginstatus" style="background-image:url(<?=$template_path?>/images/loginbox/loginbox-textfield-background.gif)" >
      <div id="LoginstatusText_2" onClick="LoginstatusTextAction(this);" onMouseOver="MouseOverLoginBoxText(this);" onMouseOut="MouseOutLoginBoxText(this);" ><div id="LoginstatusText_2_1" class="LoginstatusText" style="background-image:url(<?=$template_path?>/images/loginbox/loginbox-font-create-account.gif)" ></div><div id="LoginstatusText_2_2" class="LoginstatusText" style="background-image:url(<?=$template_path?>/images/loginbox/loginbox-font-create-account-over.gif)" ></div></div>
    </div>

    <div id="BorderRight" class="LoginBorder" style="background-image:url(<?=$template_path?>/images/general/chain.gif)" ></div>
    <div id="LoginBottom" class="Loginstatus" style="background-image:url(<?=$template_path?>/images/general/box-bottom.gif)" ></div>
  </div>

	<div class="SmallMenuBox" id="DownloadBox">
		<div class="SmallBoxTop" style="background-image:url(<?=$template_path?>/images/global/general/box-top.gif)"></div>
		<div class="SmallBoxBorder" style="background-image:url(<?=$template_path?>/images/global/general/chain.gif);"></div>
		<div class="SmallBoxButtonContainer" style="background-image:url(<?=$template_path?>/images/global/loginbox/loginbox-textfield-background.gif)">
			<a href="?subtopic=downloadclient">
			<div id="PlayNowContainer">
				<div class="MediumButtonBackground" style="background-image:url(<?=$template_path?>/images/global/buttons/mediumbutton2.gif)" onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="MediumButtonOver" style="background-image: url(<?=$template_path?>/images/global/buttons/mediumbutton-over2.gif); visibility: hidden;" ></div><input class="MediumButtonText" type="image" name="Download" alt="Download" src="<?=$template_path?>/images/global/buttons/mediumbutton_download.png"></div>
			</div>
			</a>
		</div>
	<div class="SmallBoxBorder BorderRight" style="background-image:url(<?=$template_path?>/images/global/general/chain.gif);"></div>
	<div class="Loginstatus SmallBoxBottom" style="background-image:url(<?=$template_path?>/images/global/general/box-bottom.gif);"></div>
</div>

<div-- id='Menu'>
<div id='MenuTop' style='background-image:url(<?=$template_path?>/images/general/box-top.gif);'></div>

<?php
$menus = get_template_menus();

foreach($config['menu_categories'] as $id => $cat) {
	if(!isset($menus[$id]) || ($id == MENU_CATEGORY_SHOP && !$config['gifts_system'])) {
		continue;
	}
	?>
<div id='<?php echo $cat['id']; ?>' class='menuitem'>
	<span onClick="MenuItemAction('<?php echo $cat['id']; ?>')">
		<div class='MenuButton' style='background-image:url(<?=$template_path?>/images/menu/button-background.gif);'>
			<div onMouseOver='MouseOverMenuItem(this);' onMouseOut='MouseOutMenuItem(this);'><div class='Button' style='background-image:url(<?=$template_path?>/images/menu/button-background-over.gif);'></div>
				<span id='<?php echo $cat['id']; ?>_Lights' class='Lights'>
					<div class='light_lu' style='background-image:url(<?=$template_path?>/images/menu/green-light.gif);'></div>
					<div class='light_ld' style='background-image:url(<?=$template_path?>/images/menu/green-light.gif);'></div>
					<div class='light_ru' style='background-image:url(<?=$template_path?>/images/menu/green-light.gif);'></div>
				</span>
				<div id='<?php echo $cat['id']; ?>_Icon' class='Icon' style='background-image:url(<?=$template_path?>/images/menu/icon-<?php echo $cat['id']; ?>.gif);'></div>
				<div id='<?php echo $cat['id']; ?>_Label' class='Label' style='background-image:url(<?=$template_path?>/images/menu/label-<?php echo $cat['id']; ?>.gif);'></div>
				<div id='<?php echo $cat['id']; ?>_Extend' class='Extend' style='background-image:url(<?=$template_path?>/images/general/plus.gif);'></div>
			</div>
		</div>
	</span>
	<div id='<?php echo $cat['id']; ?>_Submenu' class='Submenu'>
	<?php
		$default_menu_color = "ffffff";

		foreach($menus[$id] as $category => $menu) {
			$link_color = '#' . (strlen($menu['color']) == 0 ? $default_menu_color : $menu['color']);
			?>
			<a href='<?php echo $menu['link_full']; ?>'<?php echo $menu['blank'] ? ' target="_blank"' : ''?>>
				<div id='submenu_<?php echo str_replace('/', '', $menu['link']); ?>' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)' style="color: <?php echo $link_color; ?>;">
					<div class='LeftChain' style='background-image:url(<?=$template_path?>/images/general/chain.gif);'></div>
					<div id='ActiveSubmenuItemIcon_<?php echo str_replace('/', '', $menu['link']); ?>' class='ActiveSubmenuItemIcon' style='background-image:url(<?=$template_path?>/images/menu/icon-activesubmenu.gif);'></div>
					<div class='SubmenuitemLabel' style="color: <?php echo $link_color; ?>;"><?php echo $menu['name']; ?></div>
					<div class='RightChain' style='background-image:url(<?=$template_path?>/images/general/chain.gif);'></div>
				</div>
			</a>
			<?php
		}
	?>
	</div>
	<?php
	if($id == MENU_CATEGORY_SHOP || (!$config['gifts_system'] && $id == MENU_CATEGORY_SHOP - 1)) {
	?>
		<div id='MenuBottom' style='background-image:url(<?=$template_path?>/images/general/box-bottom.gif);'></div>
	<?php
	}
	?>
</div>
	<?php
	}
	?>
		<script type="text/javascript">
			// window.onload = function () { 
				InitializePage();
			// }
        </script>
        </div>



        <div id="ContentColumn">



          <div class="Content">

<!-- Status Bar -->
<div class="Box">
	<div class="Corner-tl" style="background-image:url(<?=$template_path?>/images/global/content/corner-tl.gif);"></div>
	<div class="Corner-tr" style="background-image:url(<?=$template_path?>/images/global/content/corner-tr.gif);"></div>
	<div class="Border_1" style="background-image:url(<?=$template_path?>/images/global/content/border-1.gif);"></div>
	<div class="BorderTitleText" style="background-image:url(<?=$template_path?>/images/global/content/title-background-blue.gif); height: 28px;">
		<div class="InfoBar">

				<img class="InfoBarBigLogo" style="margin-bottom:3px; width:60px; height:12px;" src="<?=$template_path?>/images/global/header/icon-youtube.png">
				<span class="InfoBarNumbers">
					<a class="InfoBarLinks" href="<?=$config['bar_links']['youtube']?>" target="new"><span class="InfoBarSmallElement">Youtube</span></a>
				</span>

				<img class="InfoBarBigLogo" style="margin-left: 20px;" src="<?=$template_path?>/images/global/header/icon-discord.png">
				<span class="InfoBarNumbers">
					<a class="InfoBarLinks" href="<?=$config['bar_links']['discord']?>" target="new"><span class="InfoBarSmallElement">Discord</span></a>
				</span>

				<img class="InfoBarBigLogo" style="margin-left: 20px; width:16px; height:16px;" src="<?=$template_path?>/images/global/header/icon-whatsapp.png">
				<span class="InfoBarNumbers">
					<a class="InfoBarLinks" href="<?=$config['bar_links']['whatsapp']?>" target="new"><span class="InfoBarSmallElement">Whatsapp</span></a>
				</span>

				<img class="InfoBarBigLogo" style="margin-left: 20px; width:16px; height:16px;" src="<?=$template_path?>/images/global/header/icon-instagram.png">
				<span class="InfoBarNumbers">
					<a class="InfoBarLinks" href="<?=$config['bar_links']['instagram']?>" target="new"><span class="InfoBarSmallElement">Instagram</span></a>
				</span>

				<img class="InfoBarBigLogo" style="margin-left: 20px; width:16px; height:16px;" src="<?=$template_path?>/images/global/header/icon-facebook.png">
				<span class="InfoBarNumbers">
					<a class="InfoBarLinks" href="<?=$config['bar_links']['facebook']?>" target="new"><span class="InfoBarSmallElement">Facebook</span></a>
				</span>

				<img class="InfoBarBigLogo" style="margin-left: 20px; width:16px; height:16px;" src="<?=$template_path?>/images/general/icon-info.png">
				<span class="InfoBarNumbers">
					<a class="InfoBarLinks" href="<?=$config['bar_links']['serverinfo']?>?"><span class="InfoBarSmallElement">Server info</span></a>
				</span>
				
				<img class="InfoBarBigLogo" style="margin-left: 20px; width:16px; height:16px;" src="<?=$template_path?>/images/general/icon-download.png">
				<span class="InfoBarNumbers">
					<a class="InfoBarLinks" href="<?=$config['bar_links']['download']?>"><span class="InfoBarSmallElement">Download</span></a>
				</span>

				
				
				<span style="float: right; margin-top: 1px;">
				<img class="InfoBarBigLogo" src="<?=$template_path?>/images/global/header/icon-players-online.png">
				<span class="InfoBarNumbers">
					<span class="InfoBarSmallElement">
						<a class="InfoBarLinks" href="?online">
<?php
echo getStatusText();
?>
						</a>
					</span>
				</span>

</span>

		</div>
	</div>

	
	<div class="Border_1" style="background-image:url(<?=$template_path?>/images/global/content/border-1.gif);"></div>
	<div class="CornerWrapper-b">
		<div class="Corner-bl" style="background-image:url(<?=$template_path?>/images/global/content/corner-bl.gif);"></div>
	</div>
	<div class="CornerWrapper-b">
		<div class="Corner-br" style="background-image:url(<?=$template_path?>/images/global/content/corner-br.gif);"></div>
	</div>
</div>
<!-- Status Bar -->



<div id="ContentHelper">
<?php echo tickers(); ?>
  <div id="<?php echo PAGE; ?>" class="Box">
    <div class="Corner-tl" style="background-image:url(<?=$template_path?>/images/content/corner-tl.gif);"></div>
    <div class="Corner-tr" style="background-image:url(<?=$template_path?>/images/content/corner-tr.gif);"></div>
    <div class="Border_1" style="background-image:url(<?=$template_path?>/images/content/border-1.gif);"></div>
    <div class="BorderTitleText" style="background-image:url(<?=$template_path?>/images/content/title-background-green.gif);"></div>
<?php
	$headline = $template_path.'/images/header/headline-' . PAGE . '.gif';
	if(!file_exists($headline))
		$headline = $template_path . '/headline.php?t=' . ucfirst($title);
?>
	<img class="Title" src="<?php echo $headline; ?>" alt="Contentbox headline" />
    <div class="Border_2">
      <div class="Border_3">
<?php $hooks->trigger(HOOK_TIBIACOM_BORDER_3); ?>
		<div class="BoxContent" style="background-image:url(<?=$template_path?>/images/content/scroll.gif);">
<?php echo template_place_holder('center_top') . $content; ?>
		</div>
      </div>
    </div>
    <div class="Border_1" style="background-image:url(<?=$template_path?>/images/content/border-1.gif);"></div>

    <div class="CornerWrapper-b"><div class="Corner-bl" style="background-image:url(<?=$template_path?>/images/content/corner-bl.gif);"></div></div>
    <div class="CornerWrapper-b"><div class="Corner-br" style="background-image:url(<?=$template_path?>/images/content/corner-br.gif);"></div></div>
  </div>
           </div>
          </div>
          <div id="Footer"><br/>All rights reserved 2023 - Layout by CipSoft GmbH & Meraki Team.</div>
        </div>

        <div id="ThemeboxesColumn">
		
			<div id="RightArtwork">
				<img id="PedestalRight" src="/templates/tibiacom/images/header/pedestal.gif">
					<br>
				<img id="BoostedMonster" src="<?php echo $boostedMonster['outfit']; ?>" title="Boosted Monster: <?php echo $boostedMonster['name']; ?>">	
				<img id="BoostedBoss" src="<?php echo $boostedBoss['outfit']; ?>" title="Boosted Boss: <?php echo $boostedBoss['name']; ?>">	
			</div>
			
        <div id="Themeboxes">
			<?php
			$twig_loader->prependPath(__DIR__ . '/boxes/templates');

			foreach($config['boxes'] as $box) {
				/** @var string $template_name */
				$file = TEMPLATES . $template_name . '/boxes/' . $box . '.php';
				if(file_exists($file)) {
					include($file); ?>
				<?php
				}
			}
	if($config['template_allow_change'])
		 echo '<span style="color: white">Template:</span><br/>' . template_form();
 ?>
        </div>
      </div>
     </div>
    </div>
  </div>
	<?php echo template_place_holder('body_end'); ?>

<style>
.scrollToTop {
  width: 70px;
  height: 70px;
  padding: 10px;
  text-align: center;
  font-weight: bold;
  color: #444;
  text-decoration: none;
  position: fixed;
  bottom: 10px;
  right: 10px;
  display: none;
  z-index: 50000;
}
.scrollToTop:hover {
  text-decoration: none;
  cursor: pointer;
}
</style>
<script>
	$(document).ready(function(){
		//Check to see if the window is top if not then display button
		$(window).scroll(function(){
			if ($(this).scrollTop() > 100) {
				$('.scrollToTop').fadeIn();
			} else {
				$('.scrollToTop').fadeOut();
			}
		});
		//Click event to scroll to top
		$('.scrollToTop').click(function(){
			$('html, body').animate({scrollTop : 0},800);
			return false;
		});
	});
</script>
<script>
	$(document).ready(function(){
		//Check to see if the window is top if not then display button
		$(window).scroll(function(){
			if ($(this).scrollTop() > 100) {
				$('.TopButton').fadeIn();
			}
		});
		//Click event to scroll to top
		$('.TopButton').click(function(){
			$('html, body').animate({scrollTop : 0},800);
			return false;
		});
	});
</script>
<div class="scrollToTop" style="background: url(<?=$template_path?>/images/global/content/top.png) no-repeat 0 0;"></div>

<script src="<?=$template_path?>/js/generic.js"></script>
<div id="HelperDivContainer" style="background-image: url(<?=$template_path?>/images/global/content/scroll.gif);">
	<div class="HelperDivArrow" style="background-image: url(<?=$template_path?>/images/global/content/helper-div-arrow.png);"></div>
	<div id="HelperDivHeadline"></div>
	<div id="HelperDivText"></div>
	<center><img class="Ornament" src="<?=$template_path?>/images/global/content/ornament.gif"></center><br>
</div>



</body>
</html>


