<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=$title" . time() . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<table border="1" width="100%">
	<thead>
		<tr>
			<th>SPK</th>
			<th>Regional</th>
			<th>Area</th>
			<th>Cabang</th>
			<th>Nomor Polisi</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($report as $dt) : ?>
			<tr>
				<td><?= $dt['spk']; ?></td>
				<td><?= $dt['regional']; ?></td>
				<td><?= $dt['area']; ?></td>
				<td><?= $dt['branch']; ?></td>
				<td><?= $dt['nomor_polisi']; ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>