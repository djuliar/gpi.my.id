<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ $subtitle . ' ' . strtoupper($course->course_code) . ' - ' . strtoupper($course->course_name) . ' [' .str_replace('/' , '-', $event->weeks) . ']' }}</title>
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
			margin: 1.5cm 1cm 2cm 1cm;
			counter-reset: page {{ $event->page_number -1 }};
        }
		ol, ul { font-size: 10pt; margin-top: -10px; margin-bottom: 10px;  }
		hr { page-break-before: always; border: 1px; margin-top: -25px }
		.information table { font-size: 10pt; }
		.content h2 { font-size: 12pt; text-align: left; margin-bottom: 0px; }
		.content h3, .content h4 { font-size: 10pt; text-align: left; margin-bottom: 0px; }
		.content p { text-align: justify; font-size: 10pt; font-weight: normal; margin-bottom: -10px; }
		.content table { margin-top: 10pt; border-collapse: collapse; width: 100%; }
		.content table tr th, .content table tr td { border: 1px black solid; padding: 0 10px; vertical-align: top; }
		.content table tr td ul { margin: 0; margin-left: -20px; }
		.content table tr td ol { margin: 0; margin-left: -20px; }
		.content table tr th p, .content table tr td p { margin: 0; text-align: left; }
		.content table tr th p { font-weight: bold; }
		.content blockquote { margin: 0; margin-left: 10px; padding-left: 10px; border-left: 5px #eee solid; }
		.content img { width: 76%; z-index: -100;}
		h4 { margin: 0px; }
		h4.normal { margin: 0px; font-weight: normal; }
		h5.title { margin-top: 0pt; margin-bottom: 5pt; }
		h5.subbab { font-size: 11pt; text-align: left; margin-bottom: -10pt; padding: 0; }
		.newpage { page-break-before: always; }
		.header, .footer { 
			position: fixed; 
			font-size: 10pt;
			width: 100%;
			left: 50%; 
			transform: translateX(-50%); 
			z-index: -2000; 
		}
		.header { top: 0; }
		.footer { bottom: 0; }
		#header, #footer { 
			position: absolute;
			width: 100%;
			left: 50%; 
			transform: translateX(-50%); 
			z-index: -3000; 
		}
		#header { top: -1cm; }
		#footer { top: -0.8cm; }
		pre, code { text-align: left; }
		pre { border: 1px #000 solid; font-size: 10pt; padding: 10px; background-color: #eee; line-height: 12pt; }
		pre.word-wrap { white-space: pre-wrap; white-space: -moz-pre-wrap; word-wrap: break-word; }
		table { width: 100% !important; }
		/* width: 100%; */
		.pagenum { float: right; margin-right: 1cm; font-size: 12pt; }
		.pagenum:before { counter-increment: page 0; content: counter(page); }

		@font-face {
			font-family: 'FontAwesome'; /* Use the exact font family name */
			src: url('{{ public_path('fonts/fontawesome-webfont.ttf') }}') format('truetype');
			font-weight: normal;
			font-style: normal;
		}
		/* Define CSS classes for the icons, using the specific Unicode content codes */
		.icon-ok:before {
			font-family: 'FontAwesome';
			content: "\f00c"; /* Unicode for a check mark */
		}
		.fa {
			font-family: 'FontAwesome', sans-serif;
		}
	</style>
</head>
<body>
	<!-- Header -->
	<div class="header">
		<h4>{{ $subtitle . ' - ' . strtoupper($course->course_name) }}</h4>
		<img src="{{ public_path('images/header-bg.png') }}" alt="" srcset="" id="header">
	</div>
	
	<!-- Footer -->
	<div class="footer">
		<h4>{{ strtoupper($course->prodi->prodi) }} <span class="pagenum"></span></h4>
		<img src="{{ public_path('images/footer-bg.png') }}" alt="" srcset="" id="footer">
	</div>
	
	<!-- First Page -->
	<div class="information">
		<h5 class="title">{{ 'ACARA ' . $event->event_to . '. ' . $event->title }}</h5>
		<table width="100%">
			<tr>
				<th align="left" width="33%">Pokok Bahasan</th>
				<th width="5%">:</th>
				<th align="left">{{ $event->main_topic }}</th>
			</tr>
			<tr>
				<th align="left">Acara Praktikum</th>
				<th>:</th>
				<th align="left">{{ $event->weeks }}</th>
			</tr>
			<tr>
				<th align="left">Tempat</th>
				<th>:</th>
				<th align="left">{{ $event->class_name }} di {{ $config->institution }}</th>
			</tr>
			<tr>
				<th align="left">Alokasi Waktu</th>
				<th>:</th>
				<th align="left">{{ $event->time_allocation . ' Menit' }}</th>
			</tr>
		</table>
	</div>

	<div class="content">
		<h5 class="subbab">a. Capaian Pembelajaran Mata Kuliah (CPMK)</h5>
		{!! str_replace($config->storage_path, $config->absolute_path, $event->cpmk) !!}
		
		<h5 class="subbab">b. Penilaian Bertahap BNSP (Skill Passport)</h5>
		{!! str_replace($config->storage_path, $config->absolute_path, $event->bnsp) !!}
		
		<h5 class="subbab">c. Indikator Penilaian</h5>
		{!! str_replace($config->storage_path, $config->absolute_path, $event->indicator) !!}
		
		<h5 class="subbab">d. Dasar Teori</h5>
		{!! str_replace($config->storage_path, $config->absolute_path, $event->basic_theory) !!}
		
		<h5 class="subbab">e. Alat dan Bahan</h5>
		{!! str_replace($config->storage_path, $config->absolute_path, $event->tool_material) !!}
		
		<h5 class="subbab">f. Prosedur Kerja</h5>
		{!! str_replace($config->storage_path, $config->absolute_path, $event->procedure) !!}
		
		<h5 class="subbab">g. Hasil dan Pembahasan</h5>
		{!! str_replace($config->storage_path, $config->absolute_path, $event->result) !!}
		
		<h5 class="subbab">h. Kesimpulan</h5>
		{!! str_replace($config->storage_path, $config->absolute_path, $event->conclusion) !!}
		
		<h5 class="subbab">i. Rubrik Penilaian</h5>
		{!! str_replace($config->storage_path, $config->absolute_path, $event->assessment_rubric) !!}
	</div>

</body>
</html>