<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

		<?php $this->load->view('include/style-css.php') ?>
		<?php $this->load->view('include/style-js-fitur.php') ?>

		<!-- Bootstrap 4.3.1 CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/fc-3.3.0/fh-3.1.6/kt-2.5.1/r-2.2.3/rg-1.1.1/sc-2.0.1/datatables.min.css"/>
		<!-- /Bootstrap 4.3.1 CSS -->
	</head>
	<style type="text/css">
		#graforder {
			background: #ffaf00;
			padding: 7%;
			font-size: 15pt;
		}

		#graforder:hover {
			background: none !important;
			border: 1px solid #ffaf00;
			color: black;
			transition: 0.3s;
			cursor: pointer;
		}

		#grafkredit {
			background: #e65251;
			width: 90%;
			padding: 7%;
		}

		#grafkredit:hover {
			background: none !important;
			border: 1px solid #e65251;
			color: black;
			transition: 0.3s;
			cursor: pointer;
		}

		#grafao {
			background: #6c757d;
			width: 70%;
			padding: 7%;
		}

		#grafao:hover {
			background: none !important;
			border: 1px solid #6c757d;
			color: black;
			transition: 0.3s;
			cursor: pointer;
		}

		#grafca {
			background: #8862e0;
			width: 50%;
			padding: 7%;
		}

		#grafca:hover {
			background: none !important;
			border: 1px solid #8862e0;
			color: black;
			transition: 0.3s;
			cursor: pointer;
		}

		#grafapproval {
			background: #00ce68;
			width: 30%;
			padding: 7%;
		}

		#grafapproval:hover {
			background: none !important;
			border: 1px solid #00ce68;
			color: black;
			transition: 0.3s;
			cursor: pointer;
		}

		[tooltip] {
			position: relative;
			/* opinion 1 */
		}

		/* Applies to all tooltips */
		[tooltip]::before,
		[tooltip]::after {
			text-transform: none;
			/* opinion 2 */
			font-size: 0.9em;
			/* opinion 3 */
			line-height: 1;
			user-select: none;
			pointer-events: none;
			position: absolute;
			display: none;
			opacity: 0;
		}

		[tooltip]::before {
			content: "";
			border: 5px solid transparent;
			/* opinion 4 */
			z-index: 1001;
			/* absurdity 1 */
		}

		[tooltip]::after {
			content: attr(tooltip);
			/* magic! */

			/* most of the rest of this is opinion */
			font-family: Helvetica, sans-serif;
			text-align: center;

			/* Let the content set the size of the tooltips 
			but this will also keep them from being obnoxious*/
			min-width: 3em;
			max-width: 21em;
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
			padding: 1ch 1.5ch;
			border-radius: 0.3ch;
			box-shadow: 0 1em 2em -0.5em rgba(0, 0, 0, 0.35);
			background: #333;
			color: #fff;
			z-index: 1000;
			/* absurdity 2 */
		}

		/* Make the tooltips respond to hover */
		[tooltip]:hover::before,
		[tooltip]:hover::after {
			display: block;
		}

		/* don't show empty tooltips */
		[tooltip=""]::before,
		[tooltip=""]::after {
			display: none !important;
		}

		/* FLOW: UP */
		[tooltip]:not([flow])::before,
		[tooltip][flow^="up"]::before {
			bottom: 100%;
			border-bottom-width: 0;
			border-top-color: #333;
		}

		[tooltip]:not([flow])::after,
		[tooltip][flow^="up"]::after {
			bottom: calc(100% + 5px);
		}

		[tooltip]:not([flow])::before,
		[tooltip]:not([flow])::after,
		[tooltip][flow^="up"]::before,
		[tooltip][flow^="up"]::after {
			left: 50%;
			transform: translate(-50%, -0.5em);
		}

		/* FLOW: DOWN */
		[tooltip][flow^="down"]::before {
			top: 100%;
			border-top-width: 0;
			border-bottom-color: #333;
		}

		[tooltip][flow^="down"]::after {
			top: calc(100% + 5px);
		}

		[tooltip][flow^="down"]::before,
		[tooltip][flow^="down"]::after {
			left: 50%;
			transform: translate(-50%, 0.5em);
		}

		/* FLOW: LEFT */
		[tooltip][flow^="left"]::before {
			top: 50%;
			border-right-width: 0;
			border-left-color: #333;
			left: calc(0em - 5px);
			transform: translate(-0.5em, -50%);
		}

		[tooltip][flow^="left"]::after {
			top: 50%;
			right: calc(100% + 5px);
			transform: translate(-0.5em, -50%);
		}

		/* FLOW: RIGHT */
		[tooltip][flow^="right"]::before {
			top: 50%;
			border-left-width: 0;
			border-right-color: #333;
			right: calc(0em - 5px);
			transform: translate(0.5em, -50%);
		}

		[tooltip][flow^="right"]::after {
			top: 50%;
			left: calc(100% + 5px);
			transform: translate(0.5em, -50%);
		}

		/* KEYFRAMES */
		@keyframes tooltips-vert {
			to {
				opacity: 0.9;
				transform: translate(-50%, 0);
			}
		}

		@keyframes tooltips-horz {
			to {
				opacity: 0.9;
				transform: translate(0, -50%);
			}
		}

		/* FX All The Things */
		[tooltip]:not([flow]):hover::before,
		[tooltip]:not([flow]):hover::after,
		[tooltip][flow^="up"]:hover::before,
		[tooltip][flow^="up"]:hover::after,
		[tooltip][flow^="down"]:hover::before,
		[tooltip][flow^="down"]:hover::after {
			animation: tooltips-vert 300ms ease-out forwards;
		}

		[tooltip][flow^="left"]:hover::before,
		[tooltip][flow^="left"]:hover::after,
		[tooltip][flow^="right"]:hover::before,
		[tooltip][flow^="right"]:hover::after {
			animation: tooltips-horz 300ms ease-out forwards;
		}

		.myChart {
			height: 100%;
			width: 100%;
		}

		.col-centered {
			float: none;
			/* reset the text-align */
			text-align: left;
			/* inline-block space fix */
			margin-right: -4px;
			text-align: center;
		}

		table.dataTable.table-striped.DTFC_Cloned tbody tr:nth-of-type(odd) {
			background-color: #F3F3F3;
		}

		table.dataTable.table-striped.DTFC_Cloned tbody tr:nth-of-type(even) {
			background-color: white;
		}
		.modal-dialog {
			min-width: 100%;
			max-width: 100%;
			min-height: 100%;
			max-height: 100%;
			width: 100%;
			height: 100%;
			margin: 0;
			padding: 10px;
		}

		.modal-content {
			height: auto;
			width: auto;
			min-height: 100%;
			min-width: 100%;
			border-radius: 0;
		}

		.popover {
			max-width: 25em !important;
		}

		.text-xs-center {
			text-align: center;
		}
	</style>

	<body>
		<script type="text/javascript">
			function loadCSS(e, t, n) {
				"use strict";
				var i = window.document.createElement("link");
				var o = t || window.document.getElementsByTagName("script")[0];
				i.rel = "stylesheet";
				i.href = e;
				i.media = "only x";
				o.parentNode.insertBefore(i, o);
				setTimeout(function() {
					i.media = n || "all";
				});
			}
			loadCSS("https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css");
        </script>
		
		<div class="container-scroller">
			<!-- partial:partials/_navbar.html -->
			<?php $this->load->view('include/navbarkpi.php') ?>
			<!-- partial -->
			<div class=" page-body-wrapper">
				<div class="main-panel" style="width: 100%;">
