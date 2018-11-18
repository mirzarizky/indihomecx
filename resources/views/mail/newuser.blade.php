<!DOCTYPE html>
<html>

<head>

	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
	<style type="text/css">
		body {
			width: 100%;
			background-color: #2b2a2a;
			margin: 0;
			padding: 0;
			-webkit-font-smoothing: antialiased;
			mso-margin-top-alt: 0px;
			mso-margin-bottom-alt: 0px;
			mso-padding-alt: 0px 0px 0px 0px;
		}

		p,
		h1,
		h2,
		h3,
		h4 {
			margin-top: 0;
			margin-bottom: 0;
			padding-top: 0;
			padding-bottom: 0;
		}

		span.preheader {
			display: none;
			font-size: 1px;
		}

		html {
			width: 100%;
		}

		table {
			font-size: 12px;
			border: 0;
		}

		.menu-space {
			padding-right: 25px;
		}


		@media only screen and (max-width:640px) {
			body {
				width: auto !important;
			}
			body[yahoo] .main {
				width: 440px !important;
			}
			body[yahoo] .two-left {
				width: 420px !important;
				margin: 0px auto;
			}
			body[yahoo] .full {
				width: 100% !important;
				margin: 0px auto;
			}
			body[yahoo] .alaine {
				text-align: center;
			}
			body[yahoo] .menu-space {
				padding-right: 0px;
			}

		}

		@media only screen and (max-width:479px) {
			body {
				width: auto !important;
			}
			body[yahoo] .main {
				width: 280px !important;
			}
			body[yahoo] .two-left {
				width: 270px !important;
				margin: 0px auto;
			}
			body[yahoo] .full {
				width: 100% !important;
				margin: 0px auto;
			}
			body[yahoo] .alaine {
				text-align: center;
			}
			body[yahoo] .menu-space {
				padding-right: 0px;
			}


		}
	</style>

</head>

<body yahoo="fix" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

	<!--Main Table start-->

	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#2b2a2a" style="background:#2b2a2a;">
		<tr>
			<td align="center" valign="top" style="-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; background-position: center center; background-repeat: no-repeat; background-color: #d4d4d4;">
				<table width="500" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
					<tr>
						<td height="80" align="left" valign="top">&nbsp;</td>
					</tr>
					<tr>
						<td align="left" valign="top" bgcolor="#FFFFFF" style="background:#FFF;">
							<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
								<tr>
									<td align="center" valign="top"><img src="{{asset('images/border.png')}}" width="500" height="4" alt="" style="display:block;width:100% !important; height:auto !important; " /></td>
								</tr>
								<tr>
									<td align="center" valign="top">
										<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
											<tr>
												<td align="center" valign="top">
													<table width="500" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
														<tr>
															<td align="left" valign="top">

																<!--Logo part start-->

																<table width="445" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
																	<tr>
																		<td align="center" valign="top">&nbsp;</td>
																	</tr>
																	<tr>
																		<td align="left" valign="top">
																			<table width="153" border="0" align="left" cellpadding="0" cellspacing="0" class="main">
																				<tr>
																					<td align="center" valign="top">&nbsp;</td>
																				</tr>
																				<tr>
																					<td align="center" valign="top"><a href="#"><img mc:edit="logo" editable="true" src="{{asset('images/logo.png')}}" width="153" alt="" /></a></td>
																				</tr>
																			</table>
																			<table border="0" align="right" cellpadding="0" cellspacing="0" class="main">
																				<tr>
																					<td height="18" align="right" valign="top">&nbsp;</td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																	<tr>
																		<td height="25" align="center" valign="top">&nbsp;</td>
																	</tr>
																</table>

																<!--Logo part End-->

															</td>
														</tr>
														<tr>
															<td align="left" valign="top"><img src="{{asset('images/border2.png')}}" width="500" height="23" alt="" style="display:block;width:100% !important; height:auto !important; " /></td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td align="center" valign="top">

													<!--Content part start-->

													<table width="445" border="0" align="center" cellpadding="0" cellspacing="0" class="two-left">
														<tr>
															<td align="left" valign="top">&nbsp;</td>
														</tr>
														<tr>
															<td align="left" valign="top">
																<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
																	<tr>
																		<td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:20px; color:#252525; font-weight:normal; line-height:28px; padding:6px 0px 12px 0px;" mc:edit="welcome-title">
																			<multiline>{!! $data['nama'] !!},</multiline>
																		</td>
																	</tr>
																	<tr>
																		<td align="left" valign="top" style="font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#4a4a4a; font-weight:normal; line-height:26px; padding-left:2px; padding-top:12px;" mc:edit="welcome-title-inner">
																			<multiline>
																				Akun anda telah terdaftar pada Indihome Customer Experience.
																				<br> <br>
																				<p>Berikut adalah informasi akun anda :</p>
																				<p style="font-weight:bold;">Email : {!! $data['email'] !!}</p>
																		    <p style="font-weight:bold;">NIK : {!! $data['nik'] !!}</p>
																		    <p style="font-weight:bold;">Password : {!! $data['password'] !!}</p>
																				<br>

																				Silakan login dengan klik tombol dibawah ini dan <b>segera lakukan perubahan password.</b>
																				<br> <br>
																		</td>
																	</tr>
																	<tr>
																		<td height="45" align="center" valign="middle" bgcolor="#55abd6" style="-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;background:#23272b; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#e5ae49; font-weight:bold; text-transform:uppercase;"
																		  mc:edit="newsletter-button">
																			<multiline><a href="{{route('login')}}" style="color:#FFF; text-decoration:none;">Login</a></multiline>
																		</td>
																	</tr>
																	<tr>
																		<td align="left" valign="top">
																			<table width="250" border="0" align="left" cellpadding="0" cellspacing="0">
																				<tr>
																					<td height="30" align="left" valign="top">&nbsp;</td>
																				</tr>

																				<tr>
																					<td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:15px; font-weight:normal; color:#f56333; padding-bottom:4px;" mc:edit="manager">
																						<multiline>Administrator</multiline>
																					</td>
																				</tr>
																				<tr>
																					<td align="left" valign="top" style="font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#4a4a4a; font-weight:normal; line-height:26px; padding-bottom:20px;">
																						<multiline>Indihome Customer Experience</multiline>
																					</td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
														<tr>
															<td height="30" align="left" valign="top">&nbsp;</td>
														</tr>
													</table>

													<!--Content part End-->

												</td>
											</tr>
											<tr>
												<td align="center" valign="top">
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td align="left" valign="top"><img src="{{asset('images/border2.png')}}" width="500" height="23" alt="" style="display:block;width:100% !important; height:auto !important; " /></td>
														</tr>
														<tr>
															<td align="left" valign="top">
																<table width="445" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
																	<tr>
																		<td align="left" valign="top">
																			<table border="0" align="right" cellpadding="0" cellspacing="0" class="two-left">
																				<tr>
																					<td align="center" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#010e11; font-weight:bold;" mc:edit="support">
																						<multiline>Telkom Indonesia &copy; 2018 </multiline>
																					</td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																	<tr>
																		<td height="25" align="left" valign="top">&nbsp;</td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td align="center" valign="top"><img src="{{asset('images/border.png')}}" width="500" height="4" alt="" style="display:block;width:100% !important; height:auto !important; " /></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td height="80" align="left" valign="top">&nbsp;</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

	<!--Main Table End-->

</body>

</html>
