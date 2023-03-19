<div class="col-md-12">
	<div class="table-responsive">
		<table class="table">
			<tr><td width="30%">No. Resi</td><td width="70%"><?= $rajaongkir->result->details->waybill_number; ?></td></tr>
			<tr><td>Services</td><td><?= $rajaongkir->result->summary->service_code; ?></td></tr>
			<tr><td>Tgl Pengiriman</td><td><?= $rajaongkir->result->details->waybill_date.' '.$rajaongkir->result->details->waybill_time; ?></td></tr>
			<tr><td>Asal</td><td><?= $rajaongkir->result->details->origin; ?></td></tr>
			<tr><td>Tujuan</td><td><?= $rajaongkir->result->details->destination; ?></td></tr>
			<tr><td>Pengirim</td><td><?= $rajaongkir->result->details->shippper_name; ?></td></tr>
			<tr><td>Penerima</td><td><?= $rajaongkir->result->details->receiver_name; ?></td></tr>
		</table>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">
		<div class="col-md-12">
			<h4>Riwayat</h4>
			<ul class="timeline">
				<?php 
				foreach (array_reverse($rajaongkir->result->manifest) as $key => $row) {
					if ($key == 0) {
						$style = 'style="color:#1F3DB0;"';	
					}else{
						$style = '';
					}
					echo '<li '.$style.'>
							<span class="track_judul">'.indonesian_date_2($row->manifest_date).' | '.$row->manifest_time.'</span>
							<p class="track_ket">'.$row->manifest_description.'</p>
						</li>';
				} 
				?>
			</ul>
		</div>
	</div>
</div>