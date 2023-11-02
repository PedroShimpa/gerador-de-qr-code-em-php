<?php
require './vendor/autoload.php';

use chillerlan\QRCode\QRCode;

$info = ['type' => 'text-warning', 'msg' => 'Preecha o campo link e clique em GERAR QR CODE, exemplo: http://google.com.br'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$link = $_POST["link"];
	if (!filter_var($link, FILTER_VALIDATE_URL)) {
		$info = ['type' => 'text-danger', 'msg' => 'Preecha o campo link corretamente.'];
	} else {
		$info = ['type' => 'text-success', 'msg' => 'QR code para ' .  $link . ' gerado com sucesso!'];
		$qrCode = '<img src="' . (new QRCode())->render($link) . '" alt="QR Code" class="h-auto w-50" />';
	}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Gerador de QRCode</title>
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="card card-shadow">
				<div class="card-header">
					<h1>Gerador de QR code</h1>
				</div>
				<div class="card-body">
					<div class="col-12">
						<label for="link_imagem">Link:</label>
						<form action="" method="post">
							<div class="row">
								<div class="col-4">
									<input type="text" name="link" id="link" class="form-control" required value="<?php echo $_POST["link"] ?? '' ?>">
								</div>
								<div class="col-4">
									<button type="submit" class="btn btn-primary ">Gerar QR Code</button>
								</div>
							</div>
						</form>
					</div>
					<div class="col-12">
						<h4 class="<?php echo $info['type'] ?> "><?php echo $info['msg'] ?></h4>
					</div>
					<?php if (!empty($qrCode)) : ?>
						<div class="col-12 text-center">
							<?php echo $qrCode ?>
						</div>
					<?php endif; ?>
				</div>

			</div>
		</div>
	</div>
</body>

</html>