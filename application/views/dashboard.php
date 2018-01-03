<?php require_once 'includes/header.php';	?>


<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2><?php echo $lang_dashboard; ?></h2>
		</div>
		
		
		<div class="row clearfix">
			<a href="<?= base_url() ?>pos">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="info-box bg-pink hover-expand-effect">
						<div class="icon">
							<i class="material-icons">playlist_add_check</i>
						</div>
						<div class="content">
							<div class="text"><?php echo $lang_point_of_sales; ?></div>
							<div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">125</div>
						</div>
					</div>
				</div>
			</a>
			
			
			<a href="<?= base_url() ?>sales/list_sales">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">help</i>
						</div>
                        <div class="content">
                            <div class="text"><?php echo $lang_sales; ?></div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">257</div>
						</div>
					</div>
				</div>
			</a>
			
			<a href="<?= base_url() ?>reports/sales_report">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
						</div>
                        <div class="content">
                            <div class="text"><?php echo $lang_reports; ?></div>
                            <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20">243</div>
						</div>
					</div>
				</div>
			</a>
			
			<a href="<?= base_url() ?>setting/outlets">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
						</div>
                        <div class="content">
                            <div class="text"><?php echo $lang_outlets; ?></div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20">1225</div>
						</div>
					</div>
				</div>
			</a>
			
			
			
			<a href="<?= base_url() ?>setting/users">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
						</div>
                        <div class="content">
                            <div class="text"><?php echo $lang_users; ?></div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20">1225</div>
						</div>
					</div>
				</div>
			</a>
			
			
			
			<a href="<?= base_url() ?>setting/system_setting">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
						</div>
                        <div class="content">
                            <div class="text"><?php echo $lang_system_setting; ?></div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20">1225</div>
						</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header">
					<h2>BAR CHART</h2>
					<ul class="header-dropdown m-r--5">
						<li class="dropdown">
							<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								<i class="material-icons">more_vert</i>
							</a>
							<ul class="dropdown-menu pull-right">
								<li><a href="javascript:void(0);">Action</a></li>
								<li><a href="javascript:void(0);">Another action</a></li>
								<li><a href="javascript:void(0);">Something else here</a></li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="body">
					<div id="bar_chart" class="graph"></div>
				</div>
			</div>
		</div>
		<link href="<?= base_url() ?>assets/plugins/morrisjs/morris.css" rel="stylesheet" />
		<script src="<?= base_url() ?>assets/js/pages/charts/morris.js"></script>
	</div>
</section>
<?php require_once 'includes/footer.php'; ?>