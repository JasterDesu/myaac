<?php
if(!defined('INITIALIZED'))
	exit;

if($action == "") {				
	$main_content .= '
		<div class="TableContainer">
			<div class="CaptionContainer">
				<div class="CaptionInnerContainer"> 
					<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span> 
					<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span> 
					<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);"></span> 
					<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);"></span>
					<div class="Text">Information</div>
					<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);"></span> 
					<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);"></span> 
					<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span> 
					<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span> 
				</div>
			</div>
			<table class="Table3" cellpadding="0" cellspacing="0">
				<tbody>
					<tr>
						<td>
							<div class="InnerTableContainer" >
								<table style="width:100%;" >
									<tr>
										<td>
											
											
												<div class="TableContentContainer" >
													<table class="TableContent" width="100%">
														<tr style="background-color:#D4C0A1;" >
															<td width="30%" class="LabelV">PvP Protection:</td>
															<td>to level '.$config['server']['protectionLevel'].'</td>
														</tr>
														<tr style="background-color:#F1E0C6;" >
															<td class="LabelV">Exp Rate:</td>
															<td><li>0 - 8 = 40x<br>
															<li>9 - 60 = 400x<br>
															<li>61 - 100 = 350x<br>
															<li>101 - 200 = 300x<br>
															<li>201 - 300 = 250x<br>
															<li>301 - 400 = 200x<br>
															<li>401 - 500 = 150x<br>
															<li>501 - 600 = 100x<br>
															<li>601 - 700 = 80x<br>
															<li>701 - 800 = 60x<br>
															<li>801 - 900 = 40x<br>
															<li>901 - 1000 = 20x<br>
															<li>1001 - 1200 = 10x<br>
															<li>1201 - 1400 = 8x<br>
															<li>1401 - 1600 = 5x<br>
															<li>1601 - 2000 = 3x<br>
															<li>2001 - 2200 = 2x<br>
															<li>2201+ = 1x<br>
															</td>
														</tr>
														<tr style="background-color:#D4C0A1;" >
															<td class="LabelV">Skill Rate:</td>
															<td><li>0 - 30 = 60x<br>
															<li>31 - 60 = 40x<br>
															<li>61 - 90 = 15x<br>
															<li>91 - 110 = 12x<br>
															<li>111 - 130 = 8x<br>
															<li>131 - 140 = 6x<br>
															<li>141 - 150 = 4x<br>
															<li>151+ = 2x
															</td>
														</tr>
														<tr style="background-color:#F1E0C6;" >
															<td class="LabelV">Magic Rate:</td>
															<td><li>0 - 30 = 30x<br>
															<li>31 - 60 = 15x<br>
															<li>61 - 90 = 10x<br>
															<li>91 - 110 = 7x<br>
															<li>111 - 130 = 4x<br>
															<li>131+ = 2x
															</td>
														</tr>
														<tr style="background-color:#D4C0A1;" >
															<td class="LabelV">Loot Rate:</td>
															<td><li>3X</td>
														</tr>

														<tr style="background-color:#F1E0C6;" >
															<td class="LabelV">Bestiary:</td>
															<td><li>5X</td>
														</tr>

														<tr style="background-color:#D4C0A1;" >
															<td class="LabelV">Bosstiary:</td>
															<td><li>2X</td>
														</tr>
														
														<tr style="background-color:#F1E0C6;" >
															<td class="LabelV">Red Skull Dayli:</td>
															<td><li>8</td>
														</tr>
														
														<tr style="background-color:#D4C0A1;" >
															<td class="LabelV">Red Skull Weekly:</td>
															<td><li>15</td>
														</tr>
														
														<tr style="background-color:#F1E0C6;" >
															<td class="LabelV">Red Skull 1 Monthly:</td>
															<td><li>20</td>
														</tr>
														
														<tr style="background-color:#D4C0A1;" >
															<td class="LabelV">House Kick</td>
															<td><li>5 dias off</td>
														</tr>
														
														<tr style="background-color:#F1E0C6;" >
															<td class="LabelV">Server Save</td>
															<td><li>22:30 (BR / UTC-3)</td>
														</tr>
														

													</table>
												</div>
											
											
											
											
											
											
										</td>
									</tr>
								</table>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div><br>';
}