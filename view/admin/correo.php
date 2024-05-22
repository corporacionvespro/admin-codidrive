<?php
$correo = $_POST['correo'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
$mail = new PHPMailer(true);
$subject = "Recuperar contraseña";
$subject = "=?UTF-8?B?" . base64_encode($subject) . "=?=";
try {
  $mail->SMTPDebug = SMTP::DEBUG_SERVER;
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'cixchapatutaxi@gmail.com';
  $mail->Password = 'dwawznzfdtmfuffn';
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port = 587;
  $mail->setFrom('cixchapatutaxi@gmail.com', 'Chapa tu taxi');
  $mail->addAddress($correo, 'Receptor');
  $mail->isHTML(true);
  $mail->Subject = $subject;
  $mail->Body = '<html lang="es">

  <head>
      <meta charset="UTF-8">
      <link rel="apple-touch-icon" type="image/png"
          href="https://codidrive.com/admin/assets/img/brand/logo.png">
      <meta name="apple-mobile-web-app-title" content="">
  
      <link rel="shortcut icon" type="image/png" href="https://codidrive.com/admin/assets/img/brand/logo.png">
  
      <link rel="mask-icon" type="image/png" href="https://codidrive.com/admin/assets/img/brand/logo.png">
      <title>Recuperar contraseña</title>
  </head>
<body translate="no" topmargin="0" rightmargin="0" bottommargin="0" leftmargin="0" marginwidth="0" marginheight="0"
	width="100%"
	style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%; height: 100%; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%;background-color: #F0F0F0;color: #000000;"
	bgcolor="#F0F0F0" text="#000000">
	<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0"
		style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%;" class="background">
		<tbody>
			<tr>
				<td align="center" valign="top"
					style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;" bgcolor="#F0F0F0">
					<table border="0" cellpadding="0" cellspacing="0" align="center" width="560"
						style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit;max-width: 560px;"
						class="wrapper">
						<tbody>
							<tr>
								<td align="center" valign="top"
									style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;padding-top: 20px;padding-bottom: 20px;">
									<div style="display: none; visibility: hidden; overflow: hidden; opacity: 0; font-size: 1px; line-height: 1px; height: 0; max-height: 0; max-width: 0;color: #F0F0F0;"
										class="preheader"></div>
								</td>
							</tr>
						</tbody>
					</table>
					<table border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#FFFFFF" width="560"
						style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit;max-width: 560px;"
						class="container">
						<tbody>
							<tr>
								<td align="center" valign="top"
									style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 24px; font-weight: bold; line-height: 130%;padding-top: 25px;color: #000000;font-family: sans-serif;"
									class="header">
								</td>
							</tr>
							<tr>
								<td align="center" valign="top"
									style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-bottom: 3px; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 18px; font-weight: 300; line-height: 150%;padding-top: 5px;color: #000000;font-family: sans-serif;"
									class="subheader">
									<img border="0" vspace="0" hspace="0"
										src="https://codidrive.com/admin/assets/img/brand/logo.png"
										width="300&quot;" alt="Logo" title="Logo"
										style="color: #000000;font-size: 10px;margin: 0;padding: 0;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;border: none;display: block;height: 100px;width: 100px;">
								</td>
							</tr>
							<tr>
								<td align="center" valign="top"
									style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%;padding-top: 25px; color: #000000;font-family: sans-serif;"
									class="paragraph">
									Recientemente has solicitado restablecer tu contraseña, por favor sigue el proceso
									como se te indica. En caso de que no hayas sido tú quien solicitó reestablecer, por
									favor haz caso omiso a este mensaje
								</td>
							</tr>
							<tr>
								<td align="center" valign="top"
									style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;padding-top: 25px;padding-bottom: 5px;"
									class="button"><a href="https://chapatutaxi.com/admin/restorepassword" target="_blank"
										style="text-decoration: underline;">
										<table border="0" cellpadding="0" cellspacing="0" align="center"
											style="max-width: 240px; min-width: 120px; border-collapse: collapse; border-spacing: 0; padding: 0;">
											<tbody>
												<tr>
													<td align="center" valign="middle"
														style="padding: 12px 24px; margin: 0; text-decoration: underline; border-collapse: collapse; border-spacing: 0; border-radius: 4px; -webkit-border-radius: 4px; -moz-border-radius: 4px; -khtml-border-radius: 4px;"
														bgcolor="#01296e"><a target="_blank"
															style="text-decoration: underline;color: #FFFFFF; font-family: sans-serif; font-size: 17px; font-weight: 400; line-height: 120%;"
															href="https://chapatutaxi.com/admin/restorepassword">
															Cambiar contraseña
														</a>
													</td>
												</tr>
											</tbody>
										</table>
									</a>
								</td>
							</tr>
							<tr>
								<td align="center" valign="top"
									style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;padding-top: 25px;"
									class="line">
									<hr color="#E0E0E0" align="center" width="100%" size="1" noshade=""
										style="margin: 0; padding: 0;">
								</td>
							</tr>
							<tr>
								<td align="center" valign="top"
									style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%;"
									class="list-item">
									<table align="center" border="0" cellspacing="0" cellpadding="0"
										style="width: inherit; margin: 0; padding: 0; border-collapse: collapse; border-spacing: 0;">
										<tbody>
											<tr>
												<td align="left" valign="top"
													style="font-size: 12px; font-weight: 400; line-height: 160%; border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;padding-top: 25px;color: #000000;font-family: sans-serif;"
													class="paragraph">
													Si el botón de cambiar contraseña no funciona por favor copia y pega
													el siguiente
													enlace en tu navegador <span style="font-size:11px;">
														https://chapatutaxi.com/admin/restorepassword
													</span>
												</td>
											</tr>
											<tr>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td align="center" valign="top"
									style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;padding-top: 25px;"
									class="line">
									<hr color="#E0E0E0" align="center" width="100%" size="1" noshade=""
										style="margin: 0; padding: 0;">
								</td>
							</tr>
						</tbody>
					</table>
					<table border="0" cellpadding="0" cellspacing="0" align="center" width="560"
						style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit;max-width: 560px;"
						class="wrapper">
						<tbody>
							<tr>
								<td align="center" valign="top"
									style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;padding-top: 25px;"
									class="social-icons">
									<table width="256" border="0" cellpadding="0" cellspacing="0" align="center"
										style="border-collapse: collapse; border-spacing: 0; padding: 0;">
										<tbody>
											<!--<tr>
												<td align="center" valign="middle"
													style="margin: 0; padding: 0; padding-left: 10px; padding-right: 10px; border-collapse: collapse; border-spacing: 0;">
													<a target="_blank"
														href="https://raw.githubusercontent.com/konsav/email-templates/"
														style="text-decoration: none;"><img border="0" vspace="0"
															hspace="0"
															style="padding: 0; margin: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: inline-block;color: #000000;"
															alt="F" title="Facebook" width="44" height="44"
															src="https://raw.githubusercontent.com/konsav/email-templates/master/images/social-icons/facebook.png"></a>
												</td>
												<td align="center" valign="middle"
													style="margin: 0; padding: 0; padding-left: 10px; padding-right: 10px; border-collapse: collapse; border-spacing: 0;">
													<a target="_blank"
														href="https://raw.githubusercontent.com/konsav/email-templates/"
														style="text-decoration: none;"><img border="0" vspace="0"
															hspace="0"
															style="padding: 0; margin: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: inline-block;color: #000000;"
															alt="T" title="Twitter" width="44" height="44"
															src="https://raw.githubusercontent.com/konsav/email-templates/master/images/social-icons/twitter.png"></a>
												</td>
												<td align="center" valign="middle"
													style="margin: 0; padding: 0; padding-left: 10px; padding-right: 10px; border-collapse: collapse; border-spacing: 0;">
													<a target="_blank"
														href="https://raw.githubusercontent.com/konsav/email-templates/"
														style="text-decoration: none;"><img border="0" vspace="0"
															hspace="0"
															style="padding: 0; margin: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: inline-block;color: #000000;"
															alt="G" title="Google Plus" width="44" height="44"
															src="https://raw.githubusercontent.com/konsav/email-templates/master/images/social-icons/googleplus.png"></a>
												</td>
												<td align="center" valign="middle"
													style="margin: 0; padding: 0; padding-left: 10px; padding-right: 10px; border-collapse: collapse; border-spacing: 0;">
													<a target="_blank"
														href="https://raw.githubusercontent.com/konsav/email-templates/"
														style="text-decoration: none;"><img border="0" vspace="0"
															hspace="0"
															style="padding: 0; margin: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: inline-block;color: #000000;"
															alt="I" title="Instagram" width="44" height="44"
															src="https://raw.githubusercontent.com/konsav/email-templates/master/images/social-icons/instagram.png"></a>
												</td>
											</tr>-->
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td align="center" valign="top"
									style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 13px; font-weight: 400; line-height: 150%;padding-top: 20px;padding-bottom: 20px;color: #999999;font-family: sans-serif;"
									class="footer">
									No responda a este mensaje. Este correo electrónico ha sido enviado a través de un
									sistema automatizado que no permite dar respuesta a las preguntas enviadas a esta
									dirección.
									<!--<a href="https://chapatutaxi.com/admin/restorepassword" target="_blank"
										style="text-decoration: underline; color: #999999; font-family: sans-serif; font-size: 13px; font-weight: 400; line-height: 150%;">contacto</a>-->
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</body></html>';
  $mail->send();
  echo 'Correo enviado';
} catch (Exception $e) {
  echo 'Error';
}
