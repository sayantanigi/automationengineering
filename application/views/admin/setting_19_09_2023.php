<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-12">
					<h3 class="page-title"><?= $heading;?></h3>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12">
				<div class="card">
					<div class="card-body p-0">
						<form action="<?= admin_url('Setting/update_action')?>" method="post" enctype="multipart/form-data">
							<div class="tab-content pt-0">
								<div id="general" class="tab-pane active">
									<div class="card mb-0">
										<div class="container">
											<div class="card-body">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Website Name</label>
															<input type="text" class="form-control" placeholder="Website Name" name="website_name" value="<?php if(!empty($row->website_name)){echo $row->website_name; }?>" required>
														</div>
													</div>
													<!-- <div class="col-md-6">
														<div class="form-group">
															<label>Copyright</label>
															<input type="text" class="form-control" placeholder="Copyright" name="copyright" value="<?php if(!empty($row->copyright)){ echo $row->copyright; }?>" required>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Fax</label>
															<input type="text" class="form-control" name="fax" placeholder="Fax" value="<?php if(!empty($row->fax)){echo $row->fax; }?>">
														</div>
													</div> -->
													<div class="col-md-6">
														<div class="form-group">
															<label>Phone Number</label>
															<input type="text" class="form-control" name="phone" placeholder="phone number" value="<?php if(!empty($row->phone)){echo $row->phone; }?>" required maxlength="10">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Email</label>
															<input type="text" class="form-control" placeholder="Email" name="email" value="<?php if(!empty($row->email)){echo $row->email; }?>" required>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Alternate Email</label>
															<input type="text" class="form-control" name="alternate_email" placeholder="Alternate Email" value="<?php if(!empty($row->alternate_email)){echo $row->alternate_email; }?>">
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label>Address</label>
															<textarea placeholder="Address" name="address" class="form-control" style="resize:none;" rows="4" cols="4" required><?php if(!empty($row->address)) { echo $row->address;} ?></textarea>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label>Footer About</label>
															<textarea placeholder="Footer About" name="fabout" class="form-control" style="resize:none;" rows="4" cols="4"><?php if(!empty($row->fabout)) { echo $row->fabout;} ?></textarea>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label>Facebook Link</label>
															<input type="text" class="form-control" name="fb_link" placeholder="Facebook Link" value="<?php if(!empty($row->fb_link)){echo $row->fb_link; }?>">
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label>Twitter Link</label>
															<input type="text" class="form-control" name="tw_link" placeholder="Twitter Link" value="<?php if(!empty($row->tw_link)){echo $row->tw_link; }?>">
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label>LinkedIn Link</label>
															<input type="text" class="form-control" name="lnkd_link" placeholder="LinkedIn Link" value="<?php if(!empty($row->lnkd_link)){echo $row->lnkd_link; }?>">
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label>Pinterest Link</label>
															<input type="text" class="form-control" name="ptrs_link" placeholder="Pinterest Link" value="<?php if(!empty($row->ptrs_link)){echo $row->ptrs_link; }?>">
														</div>
													</div>
													<!-- <div class="col-md-12">
														<div class="form-group">
															<label>Bahance Link</label>
															<input type="text" class="form-control" name="baha_link" placeholder="Bahance Link" value="<?php if(!empty($row->baha_link)){echo $row->baha_link; }?>">
														</div>
													</div> -->
													<div class="col-md-4">
														<div class="form-group">
															<label>Header Logo</label>
															<div class="uploader">
																<input type="file" class="form-control" name="logo">
															</div>
															<p class="form-text text-muted small mb-0">Recommended image size is <b>150px x 150px</b></p>
															<?php if(!empty($row->logo)) {
															if(!file_exists('uploads/logo/'.$row->logo)) { ?>
															<img class="rounded service-img mr-1" src="<?= base_url('uploads/no_image.png') ?>">
															<?php } else{?>
															<img class="rounded service-img mr-1" src="<?= base_url('uploads/logo/'.$row->logo) ?>">
															<?php } } else{ ?>
															<img class="rounded service-img mr-1" src="<?= base_url('uploads/no_image.png') ?>">
															<?php } ?>
															<input type="hidden" name="old_logo" value="<?php if(!empty($row->logo)){ echo $row->logo;} ?>">
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label>Footer Logo</label>
															<div class="uploader">
																<input type="file" class="form-control" name="flogo">
															</div>
															<p class="form-text text-muted small mb-0">Recommended image size is <b>150px x 150px</b></p>
															<?php if(!empty($row->flogo)) {
															if(!file_exists('uploads/logo/'.$row->flogo)) { ?>
															<img class="rounded service-img mr-1" src="<?= base_url('uploads/no_image.png') ?>">
															<?php } else {?>
															<img class="rounded service-img mr-1" src="<?= base_url('uploads/logo/'.$row->flogo) ?>">
															<?php } } else { ?>
															<img class="rounded service-img mr-1" src="<?= base_url('uploads/no_image.png') ?>">
															<?php } ?>
															<input type="hidden" name="old_flogo" value="<?php if(!empty($row->flogo)){echo $row->flogo;}?>">
														</div>
														<input type="hidden" name="id" value="<?php if(!empty($row->id)){echo $row->id;}?>">
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label>Favicon</label>
															<div class="uploader">
																<input type="file" class="form-control" name="favicon">
															</div>
															<p class="form-text text-muted small mb-0">Recommended image size is <b>16px x 16px</b> or <b>32px x 32px</b></p>
															<p class="form-text text-muted small mb-1">Accepted formats: only png and ico</p>
															<?php if(!empty($row->favicon)) {
															if(!file_exists('uploads/logo/'.$row->favicon)) { ?>
															<img class="rounded service-img mr-1" src="<?= base_url('uploads/no_image.png') ?>">
															<?php } else {?>
															<img class="rounded service-img mr-1" src="<?= base_url('uploads/logo/'.$row->favicon) ?>">
															<?php } } else { ?>
															<img class="rounded service-img mr-1" src="<?= base_url('uploads/no_image.png') ?>">
															<?php } ?>
															<input type="hidden" name="old_favicon" value="<?php if(!empty($row->favicon)){echo $row->favicon;}?>">
														</div>
														<input type="hidden" name="id" value="<?php if(!empty($row->id)){echo $row->id;}?>">
													</div>
													<div class="col-lg-12">
														<div class=" pt-0">
															<button type="submit" class="btn btn-primary">Save Changes</button>
															<a href="<?= admin_url('setting')?>" class="btn btn-outline-secondary">Cancel</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
