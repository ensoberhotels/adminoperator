@extends('admin.template.base')

@section('title', 'Ensober Admin Dashboard ')



@section('styles')
	<style>
    .quotation_main {
		width: 96%;
		margin: 0 auto;
	}
	.quotation_type {
		float: left;
		width: 100%;
		border-bottom: 2px solid #303f9f;
		padding: 39px 35px 25px;
		text-align: center;
	}
	.quo_btn {
		display: inline-block;
		background-color: #fff;
		border: 1px solid #ff4081;
		padding: 11px 30px;
		font-size: 17px;
		border-radius: 6px;
		margin: 0 15px;
		box-shadow: none;
	}
	.quo_section_title {
		display: inline-block;
		color: #303f9f;
		border-bottom: 2px solid #303f9f;
		margin: 0 0 50px;
		border-radius: 0 0 5px 5px;
		font-size: 18px;
	}
	.hotel_item {
		display: inline-block;
		width: 170px;
		border: 2px solid #303f9f;
		margin: 0 4px 13px;
		border-radius: 0 10px 0;
	}
	.hotel_item_img {
		display: inline-block;
		width: 100%;
	}
	.hotel_item_img img {
		border-radius: 0 7px 0 0;
		height: 110px;
		width: 100%;
	}
	.hotel_item_title {
		float: left;
		width: 100%;
		background-color: #303f9f;
		color: #fff;
		border-radius: 0 0 0 7px;
		padding: 4px 0;
		margin: -5px 0 0;
	}
	</style> 
@endsection



@section('content')
<div id="main">
	<div class="quotation_main">
		<!-- Quotation For -->
		<div class="quo_section quotation_type">
			<div class="quo_section_title">
				Quotation For
			</div>
			<div class="quo_section_contect">
				<button class="quo_btn">Group</button>
				<button class="quo_btn">FTI</button>
				<button class="quo_btn">Itinerary</button>
			</div>
		</div> 
		<!-- /Quotation For -->
		
		<!-- Quotation Type -->
		<div class="quo_section quotation_type">
			<div class="quo_section_title">
				Quotation Type
			</div>
			<div class="quo_section_contect">
				<button class="quo_btn">Own Hotel</button>
				<button class="quo_btn">Partner Hotel</button>
				<button class="quo_btn">Itinerary Package</button>
				<button class="quo_btn">Ready Itinerary</button>
			</div>
		</div> 
		<!-- /Quotation Type -->
		
		<!-- Hotel List -->
		<div class="quo_section quotation_type">
			<div class="quo_section_title">
				Hotel List
			</div>
			<div class="quo_section_contect">
				<div class="hotel_item">
					<div class="hotel_item_img">
						<img src="/storage/app/hotel_images/bdw1JVq8012yuDxTIHK9TBKLNcGDQBKELcHmAiGP.jpeg" class="img-responsive" />
					</div>
					<div class="hotel_item_title">
						Raj Mandir
					</div>
				</div>
				
				<div class="hotel_item">
					<div class="hotel_item_img">
						<img src="/storage/app/hotel_images/nGASRnHAAMy0687gpwfFYHJSQw7nfRyIkjhG25iD.jpeg" class="img-responsive" />
					</div>
					<div class="hotel_item_title">
						demo hotel
					</div>
				</div>
				
				<div class="hotel_item">
					<div class="hotel_item_img">
						<img src="/storage/app/hotel_images/gtGEG1NytKEzfRIENz9uEGbPpwRdMxDyfJGMXpqd.jpeg" class="img-responsive" />
					</div>
					<div class="hotel_item_title">
						Test hotel 3
					</div>
				</div>
				
				<div class="hotel_item">
					<div class="hotel_item_img">
						<img src="/storage/app/hotel_images/eq4BX4Rp93UZqjbh03CgKj2Wmepei5dc77DEkMz9.jpeg" class="img-responsive" />
					</div>
					<div class="hotel_item_title">
						The Pine Crest
					</div>
				</div>
				
				<div class="hotel_item">
					<div class="hotel_item_img">
						<img src="/storage/app/hotel_images/fRn2YQtOw2tdhrhOgy2dccgQElOcOTODbWKDrzzt.jpeg" class="img-responsive" />
					</div>
					<div class="hotel_item_title">
						Xanadu Resort
					</div>
				</div>
				
				<div class="hotel_item">
					<div class="hotel_item_img">
						<img src="/storage/app/hotel_images/OZ31RPzHCXfRUhZsJxMNT0xhm1q4i2SYbeHLDgdI.jpeg" class="img-responsive" />
					</div>
					<div class="hotel_item_title">
						Tal Paradise
					</div>
				</div>
				
				<div class="hotel_item">
					<div class="hotel_item_img">
						<img src="/storage/app/hotel_images/hYXvs5NazryXEXPFBrgI1vi2Nkwb8GShNmjG1bwj.jpeg" class="img-responsive" />
					</div>
					<div class="hotel_item_title">
						Pine Oak
					</div>
				</div>
				
				<div class="hotel_item">
					<div class="hotel_item_img">
						<img src="/storage/app/hotel_images/35j6Dlrz78HIWqL6sfiOY0vF7OAhMdxNgduiR8yP.jpeg" class="img-responsive" />
					</div>
					<div class="hotel_item_title">
						Rio Grand
					</div>
				</div>
				
				<div class="hotel_item">
					<div class="hotel_item_img">
						<img src="/storage/app/hotel_images/EjzTICmCCmcbcFenyOzGyURA2taxGtf9eNrVpsT4.jpeg" class="img-responsive" />
					</div>
					<div class="hotel_item_title">
						Hill Palace
					</div>
				</div>
				
				<div class="hotel_item">
					<div class="hotel_item_img">
						<img src="/storage/app/hotel_images/BLS2PuGzsVY2cj2PcGeRClswaOS5NM6Kg0fCrcSw.jpeg" class="img-responsive" />
					</div>
					<div class="hotel_item_title">
						Devlok Primal
					</div>
				</div>
				
				<div class="hotel_item">
					<div class="hotel_item_img">
						<img src="/storage/app/hotel_images/YFJL3ahLz1ePBrjymibbQ47E7y8jsrGXZY6BLp3Q.jpeg" class="img-responsive" />
					</div>
					<div class="hotel_item_title">
						Corbett Panorama Resort
					</div>
				</div>
			</div>
			
			
		</div> 
		<!-- /Hotel List -->
		
	</div>
</div> 
@endsection



@section('scripts')

@endsection