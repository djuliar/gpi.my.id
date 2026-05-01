<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ $subtitle . ' ' . strtoupper($course->course_code) . ' - ' . strtoupper($course->course_name) }}</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com">
	<script src="https://cdnjs.cloudflare.com"></script>
	<script>hljs.highlightAll();</script>
	<style>
		@font-face {
            font-family: 'Verdana';
            src: url('{{ public_path('fonts/Verdana.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'Verdana';
            src: url('{{ public_path('fonts/Verdana_Bold.ttf') }}') format('truetype');
            font-weight: bold;
            font-style: normal;
        }
        body {
            font-family: 'Verdana', sans-serif;
			text-align: center;
			position: relative;
			margin: 0;
        }
		ol { font-weight: bold }
		.cover { margin: 2.5cm 1cm; }
		.pengesahan { margin: 1.5cm 0cm; }
		.content { margin: 1.5cm 1cm; }
		.content h3 { text-align: center; }
		.content p { text-align: justify; font-size: 10pt; margin-bottom: -10px; }
		h4 { margin: 0px; }
		h4.normal { margin: 0px; font-weight: normal; }
		.author {
			text-align: left;
			margin-left: 4cm;
		}
		.info-cover { 
			position: absolute;
			width: 100%;
			bottom: 50px;
			left: 50%;
  			transform: translateX(-50%);
		}
		.newpage { page-break-before: always; }
		table { font-size: 9pt; }
		tr.table-header td { padding-bottom: 2cm; width: 33%; }
	</style>
</head>
<body>
	<!-- First Page -->
	<div class="cover">
		<img src="{{ public_path('images/favicon.png') }}" width="150px" alt="" srcset="">
		<h2>{{ $title }}</h2>
		<h2>{{ $subtitle }}</h2>
		<h3>{{ strtoupper($course->course_name) }}</h3>
		<h3>{{ strtoupper($course->course_code) }}</h3>
		<h3>Semester {{ strtoupper($course->semester) }}</h3>
		<br>
		<h4>Oleh:</h4>
		<div class="author">
			@php
			echo '<ol>';
			foreach ($plan->lecturer as $lecturer) {
				echo '<li>' . htmlspecialchars($lecturer['name']) . '</li>';
			}
			echo '</ol>';
			@endphp
		</div>
		<br><br><br><br>
		<div class="info-cover">
			<h4>PROGRAM STUDI {{ strtoupper($course->prodi->prodi) }}</h4>
			<h4>{{ strtoupper($config->department) }}</h4>
			<h4>{{ strtoupper($config->institution) }}</h4>
			<h4>TAHUN {{ substr($plan->launch_date, 0, 4) }}</h4>
		</div>
	</div>

	<!-- New Page -->
	<div class="newpage"></div>
	<div class="pengesahan">
		<h4>{{ strtoupper($config->ministry) }}</h4>
		<h4>{{ strtoupper($config->institution) }}</h4>
		<br>
		<h4 class="normal">LEMBAR PENGESAHAN</h4>
		<h4 class="normal">{{ $title . ' ' . $subtitle }}</h4>
		<h4>{{ strtoupper($course->course_name) }}</h4>
		<h4>{{ strtoupper($course->course_code) }}</h4>
		<br>
		<table width="100%">
			<tr class="table-header">
				<td>Mengetahui,<br>Koordinator Program Studi</td>
				<td>Koord./Tim Mata Kuliah</td>
				<td>Penulis</td>
			</tr>
			<tr>
				<td>{{ $course->prodi->coordinator }}<br>{{ $course->prodi->coordinator_nip }}</td>
				<td>{{ $workbook->course_coordinator }}<br>NIP. {{ $workbook->course_coordinator_nip }}</td>
				<td>{{ $workbook->author }}<br>NIP. {{ $workbook->author_nip }}</td>
			</tr>
		</table>
		<table width="100%" style="margin-top: 1cm;">
			<tr class="table-header">
				<td></td>
				<td>Menyetujui,<br>Ketua Jurusan</td>
			</tr>
			<tr>
				<td></td>
				<td colspan='2'>{{ $config->department_leader }}<br>NIP. {{ $config->department_leader_nip }}</td>
			</tr>
		</table>
	</div>
	
	<!-- New Page -->
	<div class="newpage"></div>
	<div class="content">
		<h3>KATA PENGANTAR</h3>
		{!! $plan->introduction !!}
	</div>
	<table width="100%">
			<tr>
				<td width="50%"></td>
				@php
					$date_object = new DateTime($plan->launch_date);
					$formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
					$formatter->setPattern('d MMMM yyyy');
				@endphp
				<td style="padding-bottom: 2cm;">{{ $plan->launch_city }}, {{ $formatter->format($date_object) }}<br>Penulis</td>
			</tr>
			<tr>
				<td></td>
				<td><strong>{{ $plan->author }}</strong><br>NIP. {{ $plan->author_nip }}</td>
			</tr>
	</table>
	
	<!-- New Page -->
	<?php
		foreach ($plan->additional_page as $page) { ?>
			<div class="newpage"></div>
			<div class="content" style="text-align: left">
				<h3>{{ $page['title'] }}</h3>
				{!! $page['content'] !!}
			</div>
	<?php } ?>

</body>
</html>