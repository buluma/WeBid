		<div class="row">
			<div class="col-md-3">
				<!-- INCLUDE sidebar-{CURRENT_PAGE}.tpl -->
			</div>
			<div class="col-md-9">
				<ol class="breadcrumb"><i class="fa fa-cogs"></i>  <li>{L_25_0023}</li><li>{L_5318}</li></ol>
				<div class="panel panel-default">
					<div class="panel-body">
				        <div style="font-size: 16px; font-weight: bold; text-align: center;" class="centre">
					        {L_5438}<i>{SITENAME}</i><br>
					        {STATSMONTH}
				        </div>
				        <div style="text-align: center;" class="centre">
					        <a href="viewaccessstats.php">{L_5143}</a> | <a href="viewbrowserstats.php">{L_5165}</a>
				        </div>
			        </div>
				</div>

				
				<table class="table table-bordered table-hover table-striped">
					<tr>
						<th align="center" width="150"><b>{L_5156}</b></td>
						<th height="21" style="text-align:right;">&nbsp;</td>
					</tr>
<!-- BEGIN sitestats -->
					<tr class="bg">
						<td align="center" height="45"><b>{sitestats.PLATFORM}</b></td>
						<td>
	<!-- IF sitestats.NUM eq 0 -->
							<div"><b>0</b></div>
	<!-- ELSE -->
							<div style="width:{sitestats.WIDTH}%; background-color:#006699; color:#FFFFFF;"><b>{sitestats.PERCENTAGE}%</b></div>
	<!-- ENDIF -->
						</td>
					</tr>
<!-- END sitestats -->
				</table>
				
			</div>
		</div>