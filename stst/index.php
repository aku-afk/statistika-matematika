<?php

$content = 'none';

if (isset($_GET['jklas'])) {
	$kelas = $_GET['jklas'];
	$content = 'block';
}

if (isset($_POST['cobo'])) {
include "./lib.php";
}
//echo "<pre>";
//print_r($nx);
//print_r($nf);
//echo "</pre>";

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>statistika mtk [data kelompok]</title>

	<style type="text/css">
		.io {
			display: <?php echo $content; ?>;
			overflow: auto;
		}
		body {
			font-family: courier;
			padding-left: 5%;
			padding-right: 5%;
		}
		tr {
			height: 30px;
			border: 1px solid #000;
		}
		td {
			text-align: center;
			align-items: center;
			padding-left: 10px;
			padding-right: 10px;
		}
		input[class=xi] {
			width: 50px;
		}
		.usr:hover {
			background: #3cb371;
			/*border: 1px solid #fae;*/
		}
		.xi {
			text-align: center;
		}
		.kop{
			text-align: center;
			background: #000;
			color: #fff;
		}
		.nval,
		.nfrq,
		.nval:active,
		.nfrq:active {
			height: 100%;
			width: 60px;
			border: none;
			background: transparent;
			text-align: center;
		}
		.in {
			padding-left: 1px;
			padding-right: 1px;
		}
		.bracket {
			text-align: center;
		}
		.submit {
			width: 100%;
		}
		.pencet {
			padding-top: 10px;
		}
		.hdn {
			visibility: hidden;
		}
		.ga {
			background: #ccc;
		}
		.persentil {
			margin-top: -40px;
			height: 300px;
			overflow: auto;
		}
		.hasile {
			height: 400px;
			margin-top: 20px;
			overflow: auto;
		}
	</style>
</head>
<body>
	<form action="#" method="get">
		<table>
			<tr>
				<td>JML KELAS  : </td>
				<td><input class="xi" type="number" name="jklas" value="<?php echo $kelas; ?>"></td>
			</tr>
		</table>
	</form>

	<form class="io" action="" method="post">
		<table>
			<tr class="kop">
				<td>K</td>
				<td colspan="3">DATA</td>
				<td>(fi)</td>
				<td>(xi)</td>
				<td>(fi)(xi)</td>
			</tr>

			<?php
				for ($i=0; $i < $kelas; $i++) { 
					//$nix = 'x'.$i;
					//$nif = 'f'.$i;
					if ($i % 2 == 0) {
						$theme = 'ge';
					} else {
						$theme = 'ga';
					}
			?>
			<tr class="<?php echo $theme; ?>">
				<td class="usr xi"><?php echo ($i + 1); ?></td>
				<td class="usr in"><input class="nval" type="number" placeholder="..." name="<?php echo "xa_".$i; ?>" value="<?php echo $nx['a'][$i] ?>" required></td>
				<td class="bracket"> - </td>
				<td class="usr in"><input class="nval" type="number" placeholder="..." name="<?php echo "xb_".$i; ?>" value="<?php echo $nx['b'][$i] ?>" required></td>
				<td class="usr in"><input class="nfrq" type="number" placeholder="..." name="<?php echo "f_".$i; ?>" value="<?php echo $nf[$i] ?>" required></td>
				<?php if (isset($_POST['cobo'])) { ?>
				<td class="usr xi"><?php echo $nite[$i]; ?></td>
				<?php $fixi[$i] = $has['rta'][$i]; ?>
				<td class="usr xi"><?php echo $fixi[$i]; ?></td>
				<?php } ?>
			</tr>
			<?php
				}
			?>

			<tr class="kop">
				<td colspan="4">TOTAL</td>
				<td class="usr"><?php echo array_sum($nf); ?></td>
				<td class="usr"><?php echo array_sum($nite); ?></td>
				<td class="usr"><?php echo array_sum($fixi); ?></td>
			</tr>
			<tr>
				<td class="pencet" colspan="7">
					<input class="submit" type="submit" name="cobo" value=" HITUNG ">
				</td>
			</tr>
		</table>
	</form>

	<div class="hasile">
		<pre>
		<?php
			if (isset($_POST['cobo'])) {
				echo "\n\n";
				// MEAN
				echo "MEAN [ RATA-RATA ] : \n";
				echo ">  ".$has['rta']['all']."\n";
				echo "\n\n";
				// MEDIAN
				echo "MEDIAN : \n";
				echo ">  ".$has['mdi']."\n";
				echo "\n\n";
				// MODUS
				echo "MODUS : \n";
				echo ">  ".$has['mds']."\n";
				echo "\n\n";
				// KUARTIL
				echo "KUARTIL : \n";
				for ($qix[0]=0; $qix[0] < $kuartil; $qix[0]++) { 
					$qix[1] = ($qix[0] + 1);
					echo "Q".$qix[1]." >  ".$has['qk'][$qix[0]]."\n";
				}
				echo "\n\n";
				// DESIL
				echo "DESIL : \n";
				for ($qix[0]=0; $qix[0] < $desil; $qix[0]++) { 
					$qix[1] = ($qix[0] + 1);
					echo "D".$qix[1]." >  ".$has['di'][$qix[0]]."\n";
				}
				echo "\n\n";
				// PERSENTIL
				echo "PERSENTIL : \n";
		?>
		</pre>
		<pre class="persentil">
		<?php
				echo "\n";
				for ($qix[0]=0; $qix[0] < $persentil; $qix[0]++) { 
					$qix[1] = ($qix[0] + 1);
					if ($qix[1] < 10) {
						echo "P".$qix[1]."  >  ".$has['pi'][$qix[0]]."\n";
					} else {
						echo "P".$qix[1]." >  ".$has['pi'][$qix[0]]."\n";
					}
				}
		?>
		</pre>
		<pre>
		<?php
				echo "\n";
				// JANGKAUAN
				$has['jankau'] = ($tepi[($kelas - 1)]['a'] - $tepi[0]['b']);
				echo "JANGKAUAN : \n";
				echo ">  ".$has['jankau']."\n";
				echo "\n\n";
				// HAMPARAN
				$has['hmp'] = ($has['qk'][2] - $has['qk'][0]);
				echo "HAMPARAN : \n";
				echo ">  ".$has['hmp']."\n";
				echo "\n\n";
				// SIMPANGAN KUARTIL
				$has['simkr'] = ($has['hmp'] / 2);
				echo "SIMPANGAN KUARTIL : \n";
				echo ">  ".$has['simkr']."\n";
				echo "\n\n";
				// SIMPANGAN RATA-RATA
				//$has['simkr'] = ($has['hmp'] / 2);
				//echo "SIMPANGAN RATA-RATA : \n";
				//echo ">  ".$has['simra']."\n";
				echo "\n\n";
			}
		?>
		</pre>
	</div>
</body>
</html>