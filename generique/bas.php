</section>

<!--- container to hold notifications, and default templates --->
	<div id="container" style="display:none">
		<div id="default">
			<h1>#{title}</h1>
			<p>#{text}</p>
		</div>
		
		<div id="sticky" class="#{class}">
			<a class="ui-notify-close ui-notify-cross" href="#">x</a>
			<h1>#{title}</h1>
			<p>#{text}</p>
		</div>
		
		<div id="themeroller" class="ui-state-error" style="padding:10px; -moz-box-shadow:0 0 6px #980000; -webkit-box-shadow:0 0 6px #980000; box-shadow:0 0 6px #980000;">
			<a class="ui-notify-close" href="#"><span class="ui-icon ui-icon-close" style="float:right"></span></a>
			<span style="float:left; margin:2px 5px 0 0;" class="ui-icon ui-icon-alert"></span>
			<h1>#{title}</h1>
			<p>#{text}</p>
			<p style="text-align:center"><a class="ui-notify-close" href="#">Close Me</a></p>
		</div>
		
		<div id="withIcon">
			<a class="ui-notify-close ui-notify-cross" href="#">x</a>
			<div style="float:left;margin:0 10px 0 0"><img src="#{icon}" alt="warning" /></div>
			<h1>#{title}</h1>
			<p>#{text}</p>
		</div>
		
		<div id="buttons">
			<h1>#{title}</h1>
			<p>#{text}</p>
			<p style="margin-top:10px;text-align:center">
				<input type="button" class="confirm" value="Close Dialog" />
			</p>
		</div>
	</div>
<!--- ./container --->
<footer>
<?php if( $user->isWindowsLive($_SESSION['id']) ): ?>
	<div id="dialog-upload" style="display: none; z-index: 1007; outline: 0px none; height: auto; width: 400px; top: 120px; left: 380px;" class="ui-dialog ui-widget ui-widget-content ui-corner-all  ui-draggable" tabindex="-1" role="dialog" aria-labelledby="ui-dialog-title-HtmlOutputArea">
		<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
			<span class="ui-dialog-title" id="ui-dialog-title-HtmlOutputArea">Enregistrer dans SkyDrive</span>
			<a href="#" class="ui-dialog-titlebar-close ui-corner-all" role="button">
				<span class="ui-icon ui-icon-closethick" onClick="uploadBoxClose();">close</span>
			</a>
		</div>
		<div id="HtmlOutputArea" class="ui-dialog-content ui-widget-content" style="width: auto; min-height: 108.267px; height: auto; display: block;">
			<div id="save-to-skydrive-dialog">
				<div id="save-to-skydrive-dialog-content">
					<p>Sélectionner un fichier</p>
					<form>
						<input type="file" id="save-to-skydrive-file-input" name="file">
					</form>
					<button id="save-to-skydrive-upload-button" disabled="">Télécharger</button>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
</footer>
<?php if( $user->isWindowsLive($_SESSION['id']) ): ?>
 <script src="//js.live.net/v5.0/wl.js"></script>
<script>
	function uploadBox() {
		document.getElementById('dialog-upload').style.display = "block";
		return false;
	}
	
	function uploadBoxClose() {
		document.getElementById('dialog-upload').style.display = "none";
		return false;
	}

	WL.init({ client_id: "00000000480D369C", redirect_uri: "http://noteit.indydedeken.fr/dashboard" });

	WL.login({ "scope": "wl.skydrive_update" }).then(
		function(response) {
			registerOnClickHandlers();
		},
		function(response) {
			alert( "Failed to authenticate." );
		}
	);
	
	function registerOnClickHandlers() {
		var uploadFileButton = document.getElementById('save-to-skydrive-upload-button');
		uploadFileButton.disabled = true;
		uploadFileButton.onclick = function() {
			uploadBoxClose();
			saveToSkyDrive();
			create("sticky", { class:'succes', title:'Téléchargement :', text:'Le fichier vient de partir vers le serveur.'}, { custom: true });
		};
	
		var fileInputElement =
			document.getElementById('save-to-skydrive-file-input');
		fileInputElement.onchange = function() {
			uploadFileButton.disabled = (fileInputElement.value === "");
		};
	}
	
	function saveToSkyDrive() {
		WL.fileDialog({ mode: 'save' }).then(
			function(response) {
				var folder = response.data.folders[0];
				
				WL.upload({
					path: folder.id,
					element: 'save-to-skydrive-file-input',
					overwrite: 'rename'
				}).then(
					function(response) {
						//console.log(JSON.stringify(response));
					},
					function(errorResponse) {
						alert( JSON.stringify(errorResponse) );
					}, 
					function(progress) {
						//console.log(progress);
						create("sticky", { class:'succes', title:'Téléchargement :', text:'Fichier arrivé à bon port !'}, { custom: true });
					}
				);
			}, function(errorResponse) {
				//log("WL.fileDialog errorResponse = " + JSON.stringify(errorResponse));
			}
		);
	}
</script>
<?php endif; ?>
</body>
</html>