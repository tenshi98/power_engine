<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>elFinder</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2" />

		<!-- Require JS (REQUIRED) -->
		<!-- Rename "main.default.js" to "main.js" and edit it if you need configure elFInder options or any things -->
		<script data-main="./main.default.js" src="http://cdnjs.cloudflare.com/ajax/libs/require.js/2.3.2/require.min.js"></script>
		<script>
			define('elFinderConfig', {
				// elFinder options (REQUIRED)
				// Documentation for client options:
				// https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
				defaultOpts : {
					url : 'php/<?php echo $_GET['conector']; ?>.php?emp_path=<?php echo $_GET['emp_path']; ?>&id_emp=<?php echo $_GET['id_emp']; ?>&prm=<?php echo $_GET['prm']; ?>' // connector URL (REQUIRED)
					,cssAutoLoad  : [
						'./themes/Material/css/theme-gray.css'
					]
					,lang : 'es'
					,height: '650'
					,defaultView : 'list'
					<?php if($_GET['type']==1){ ?>
					,uiOptions : {
						// toolbar configuration
						toolbar : [
							['back', 'forward'],
							['reload'],
							['open', 'download', 'getfile'],
							['info'],
							['quicklook'],
							['search']
						],
					}
					,contextmenu : {
						// navbarfolder menu
						navbar : ['open', 'info'],
						// current directory menu
						cwd    : ['reload', 'back', '|', 'info'],
						// current directory file menu
						files  : [
							'open', 'quicklook', '|', 'download', '|', 'info'
						]
					}
					<?php }elseif($_GET['type']==2){ ?>
					,uiOptions : {
						// toolbar configuration
						toolbar : [
							['back', 'forward'],
							['reload'],
							['home', 'up'],
							['mkdir', 'mkfile', 'upload'],
							['open', 'download', 'getfile'],
							['info'],
							['quicklook'],
							['copy', 'cut', 'paste'],
							['rm'],
							['duplicate', 'rename', 'edit', 'resize'],
							['extract', 'archive'],
							['search'],
							['view']
						],
					}	
					,contextmenu : {
						// navbarfolder menu
						navbar : ['open', '|', 'copy', 'cut', 'paste', 'duplicate', '|', 'rm', '|', 'info'],

						// current directory menu
						cwd    : ['reload', 'back', '|', 'upload', 'mkdir', 'mkfile', 'paste', '|', 'info'],

						// current directory file menu
						files  : [
							'getfile', '|','open', 'quicklook', '|', 'download', '|', 'copy', 'cut', 'paste', 'duplicate', '|',
							'rm', '|', 'edit', 'rename', 'resize', '|', 'archive', 'extract', '|', 'info'
						]
					}	
						
					<?php } ?>
						
					,commandsOptions : {
						quicklook : {
							width : 640,  // Set default width/height voor quicklook
							height : 480,
							// to enable preview with Google Docs Viewer
							googleDocsMimes : ['application/pdf', 'image/tiff', 'application/vnd.ms-office', 'application/msword', 'application/vnd.ms-word', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']
						},
						rm : {
							shortcuts : []
						}
					}
					// bootCalback calls at before elFinder boot up 
					,bootCallback : function(fm, extraObj) {
						/* any bind functions etc. */
						fm.bind('init', function() {
							// any your code
						});
						// for example set document.title dynamically.
						var title = document.title;
						fm.bind('open', function() {
							var path = '',
								cwd  = fm.cwd();
							if (cwd) {
								path = fm.path(cwd.hash) || null;
							}
							document.title = path? path + ':' + title : title;
						}).bind('destroy', function() {
							document.title = title;
						});
					}
					
					,handlers : {
						dblclick : function(event, elfinderInstance) {
						  event.preventDefault();
						  elfinderInstance.exec('getfile')
							.done(function() { elfinderInstance.exec('quicklook'); })
							.fail(function() { elfinderInstance.exec('open'); });
						}
					}

					,getFileCallback : function(files, fm) {
						return false;
					}
				},
				managers : {
					// 'DOM Element ID': { /* elFinder options of this DOM Element */ }
					'elfinder': {}
				}
			});
		</script>
	</head>
	<body>

		<!-- Element where elFinder will be created (REQUIRED) -->
		<div id="elfinder"></div>

	</body>
</html>


