		<div class="row">
			<div class="col-md-3">
				<!-- INCLUDE sidebar-{CURRENT_PAGE}.tpl -->
			</div>
			<div class="col-md-9">
				<ol class="breadcrumb"><i class="fa fa-cogs"></i>  <li>{L_25_0009}</li><li>{L_30_0215}</li></ol>
				<form name="logo" action="" method="post" enctype="multipart/form-data">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row grid-margin-btm-md">
								<div class="col-md-3">{L_531}</div>
								<div class="col-md-9"><img src="{IMAGEURL}"></div>
							</div>
							<div class="row">
								<div class="col-md-3">{L_602}</div>
								<div class="col-md-9">
									<label class="btn btn-primary btn-sm" for="logo">
										Browse <input id="logo" type="file" name="logo" style="display:none;">
									</label>
								</div>
							</div>
						</div>
					</div>
					<input type="hidden" name="action" value="update">
					<input type="hidden" name="csrftoken" value="{_CSRFTOKEN}">
					<button class="btn btn-primary" type="submit" name="act">{L_30_0215}</button>
				</form>
			</div>
		</div>
<!-- INCLUDE footer.tpl -->
