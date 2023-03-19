<style type="text/css">
	ul.timeline {
	    list-style-type: none;
	    position: relative;
	}
	ul.timeline:before {
	    content: ' ';
	    background: #d4d9df;
	    display: inline-block;
	    position: absolute;
	    left: 29px;
	    width: 2px;
	    height: 100%;
	    z-index: 400;
	}
	ul.timeline > li {
	    margin: 20px 0;
	    padding-left: 20px;
	}
	ul.timeline > li:before {
	    content: ' ';
	    background: white;
	    display: inline-block;
	    position: absolute;
	    border-radius: 50%;
	    border: 3px solid #000000;
	    left: 20px;
	    width: 20px;
	    height: 20px;
	    z-index: 400;
	}

	.track_judul {
		margin-left: 25px;
	}

	.track_ket {
		margin-left: 25px;
	}
</style>
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
		<div class="col-md-12 offset-md-4">
			<h4>Riwayat</h4>
			<ul class="timeline">
				<?php 
				foreach (array_reverse($rajaongkir->result->manifest) as $key => $row) {
					if ($key == 0) {
						$style = 'style="color:#32c670;"';	
					}else{
						$style = '';
					}

					echo '<li '.$style.'>
							<span class="track_judul">'.$row->manifest_date.' '.$row->manifest_time.'</span>
							<p class="track_ket">'.$row->manifest_description.'</p>
						</li>';
				} 
				?>
			</ul>
		</div>
	</div>
</div>