<?php

for ($indat=0; $indat < $kelas; $indat++) {
	$nx['a'][$indat] = $_POST["xa_$indat"];
	$nx['b'][$indat] = $_POST["xb_$indat"];
	$nf[$indat] = $_POST["f_$indat"]; 
}

for ($i=0; $i < $kelas; $i++) { 
	$nite[$i] = ($nx['a'][$i] + (($nx['b'][$i] - $nx['a'][$i]) / 2));
	$pada[$i] = (($nx['b'][$i] - $nx['a'][$i]) + 1);
	$tepi[$i]['b'] = ($nx['a'][$i] - 0.5);
	$tepi[$i]['a'] = ($nx['b'][$i] + 0.5);

	if ($i == 0) {
		$akum['frq'][$i] = $nf[$i];
	} else {
		$ih = ($i - 1);
		$akum['frq'][$i] = ($akum['frq'][$ih] + $nf[$i]);
	}
}

$jfrq = array_sum($nf);

$kuartil = 3;
$desil = 9;
$persentil = 99;

//echo "<pre>";
//print_r($nite);
//print_r($tepi);
//print_r($pada);
//print_r($jfrq);
//echo "</pre>";


// MEAN ----------------------------------------
for ($i=0; $i < $kelas; $i++) { 
	$has['rta'][$i] = ($nite[$i] * $nf[$i]);
}
$has['rta']['all'] = (array_sum($has['rta']) / $jfrq);



// MEDIAN --------------------------------------
$tcer = ($jfrq / 2);
for ($i=0; $i < $kelas;) {
	if ($tcer <= ($akum['frq'][$i])) {
		$pos[0] = $i;
		$pos[1] = ($pos[0] - 1);
		$i = $kelas;
	} else {
		$i++;
	}
}
$mdi = (($tcer - $akum['frq'][$pos[1]]) / $nf[$pos[0]]);
$has['mdi'] = ($tepi[$pos[0]]['b'] + ($pada[$pos[0]] * $mdi));



// MODUS ---------------------------------------
$locx = max($nf);
for ($i=0; $i < $kelas; $i++) { 
	if ($nf[$i] == $locx) {
		$loc = $i;
		$i = ($i + $kelas);
	}
}
$d[1] = abs(($nf[$loc] - $nf[$loc-1]));
$d[2] = abs(($nf[$loc+1] - $nf[$loc]));
$d[0] = ($d[1] / ($d[1] + $d[2]));
$has['mds'] = ($tepi[$loc]['b'] + ($pada[$loc] * $d[0]));


// KUARTIL -------------------------------------
for ($qi=0; $qi < $kuartil; $qi++) { 
	$qx = ($qi + 1);
	$pat = (($jfrq * $qx) / 4);
	$posi = 0;
	for ($i=0; $i < $kelas;) {
		if ($pat <= $akum['frq'][$i]) {
			$posi = $i;
			$i = $kelas;
		} else {
			$i++;
		}
	}
	$posix = ($posi - 1);
	$watu = (($pat - $akum['frq'][$posix]) / $nf[$posi]);
	$has['qk'][$qi] = ($tepi[$posi]['b'] + ($pada[$posi] * $watu));
}


// DESIL -------------------------------------
for ($di=0; $di < $desil; $di++) { 
	$dx = ($di + 1);
	$pat = (($jfrq * $dx) / 10);
	$posi = 0;
	for ($i=0; $i < $kelas;) {
		if ($pat <= $akum['frq'][$i]) {
			$posi = $i;
			$i = $kelas;
		} else {
			$i++;
		}
	}
	$posix = ($posi - 1);
	$watudi = (($pat - $akum['frq'][$posix]) / $nf[$posi]);
	$has['di'][$di] = ($tepi[$posi]['b'] + ($pada[$posi] * $watudi));
}


// PERSENTIL -------------------------------------
for ($pi=0; $pi < $persentil; $pi++) { 
	$qx = ($pi + 1);
	$pat = (($jfrq * $qx) / 100);
	$posi = 0;
	for ($i=0; $i < $kelas;) {
		if ($pat <= $akum['frq'][$i]) {
			$posi = $i;
			$i = $kelas;
		} else {
			$i++;
		}
	}
	$posix = ($posi - 1);
	$watupi = (($pat - $akum['frq'][$posix]) / $nf[$posi]);
	$has['pi'][$pi] = ($tepi[$posi]['b'] + ($pada[$posi] * $watupi));
}


// SIMPANGAN RATA RATA -------------------------
for ($sr=0; $sr < 1; $sr++) { 
	// code...

}

?>