<!DOCTYPE html>
<html lang="ko">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>HTML Manual Navigator</title>
	<link href=".bs/css/bootstrap.min.css" rel="stylesheet">
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src=".bs/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		var os;
		var model;
		var lang;
		var path;

		$(document).ready(function() {
			// $('select:not(:has(option))').attr('disabled', true);;
			$('#os').change(function() {
				update_models();
			});
			$('#model').change(function() {
				model = $("#model option:selected").text();
				update_langs();
			});
			$('#lang').change(function() {
				lang = $("#lang option:selected").text();
				console.log("OS: " + os + " / Model: " + model + " / Language: " + lang);
				update_path();
			})
		})

		function update_models() {
			os = $("#os option:selected").val();
			$.get('get_subfolder.php?dir=' + os, show_models);
		}

		function show_models(res) {
			$('#model').html(res);
			model = $('#model option:first').text();
			// console.log(model);
			update_langs();
		}

		function update_langs() {
			$.get('get_subfolder.php?parent=' + os + '&dir=' + model, show_langs);
		}

		function show_langs(res) {
			$('#lang').html(res);
			lang = $('#lang option:first').text();
			// console.log(lang);
			console.log("OS: " + os + " / Model: " + model + " / Language: " + lang);
			update_path();
		}

		function update_path() {
			// alert(os + '_' + model);
			$.get('get_checklist.php?os=' + os + '&model=' + model, show_checklist);
		}

		function show_checklist(res) {
			$('#checklist').html(res);
		}

		function openUrl() {
			os = $("#os option:selected").val();
			model = $("#model option:selected").val();
			lang = $("#lang option:selected").val();
			if($("#lang option:selected").val() == 'undefined' || $("#lang option:selected").val() == null)
				alert("언어를 선택해주세요");
			else
				window.open("/" + os + "/" + model + "/" + lang + '/start_here.html', '_blank');
		}

		function saveUrl() {
			os = $("#os option:selected").val();
			model = $("#model option:selected").val();
			lang = $("#lang option:selected").val();
			if($("#lang option:selected").val() == 'undefined' || $("#lang option:selected").val() == null)
				alert("언어를 선택해주세요")();
			else
				path = './' + os + '/' + model + '/' + lang;
				location.href = "zipper.php?path=" + path + "&name=" + lang;
		}

		function saveChecklist() {
			os = $("#os option:selected").val();
			model = $("#model option:selected").val();
			path = "./" + os + "/" + model + "/" + $("#checklist option:selected").text();
			// alert(path);
			console.log(path);
			window.location.href = path;
		}
	</script>
	<style>
	.btn {font-weight: bold;}
	</style>
</head>

<body>
<div class="container">
	<div class="page-header">
		<h3>:: <a href="./" target="_self">매뉴얼 네비게이터</a> ::</h3>
	</div>
	<div>
		<form>
			<div class="form-group">
				<h4>OS 선택</h4>
				<select class="form-control" id="os" name="os">
					<?php
					foreach (glob('./*', GLOB_ONLYDIR) as $dir) {
						$dirname = basename($dir);
						echo "<option value=\"$dirname\">".$dirname."</option>\r\n";
					}
					?>					
				</select>
			</div>
			<div class="form-group">
				<h4>모델 선택</h4>
				<select class="form-control" id="model" name="model">
					<!-- <option selected="selected" disabled="disabled">OS를 선택해야 나타납니다.</option> -->
				</select>
			</div>
			<div class="form-group">
				<h4>언어 선택</h4>
				<select class="form-control" id="lang" name="lang">
					<!-- <option selected="selected" disabled="disabled">모델을 선택해야 나타납니다.</option> -->
				</select>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<h4>기능 선택</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<a class="btn btn-primary btn-block" id="btn_open" onclick="openUrl()">Open Manual</a>
				</div>
				<div class="col-xs-6">
					<a class="btn btn-success btn-block" id="btn_save" onclick="saveUrl()">Save Manual</a>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<p></p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<select class="form-control" name="checklist" id="checklist"></select>
				</div>
				<div class="col-xs-6">
					<a class="btn btn-warning btn-block" id="btn_save_check" onclick="saveChecklist()">Save Checklist</a>
				</div>
			</div>
		</form>
	</div>
</div>
</body>

</html>