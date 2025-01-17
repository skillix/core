<?php
if (!isConnect('admin')) {
	throw new Exception('{{401 - Accès non autorisé}}');
}
$page = init('page', 1);
$list_logfile = array();
$dir = opendir('log/');
$logExist = false;
while ($file = readdir($dir)) {
	if ($file != '.' && $file != '..' && $file != '.htaccess' && !is_dir('log/' . $file)) {
		$list_logfile[] = $file;
	}
}
natcasesort($list_logfile);
?>

<div class="row row-overflow">
	<div class="col-lg-2 col-md-3 col-sm-4" id="div_displayLogList">
		<div class="bs-sidebar">
			<ul id="ul_object" class="nav nav-list bs-sidenav">
				<li style="margin-bottom: 5px;">
					<div class="input-group">
						<span class="input-group-btn">
							<input id="in_searchLogFilter" class="form-control input-sm roundedLeft" placeholder="{{Rechercher | nom | :not(nom}}" style="width: calc(100% - 20px)"/>
							<a id="bt_resetLogFilterSearch" class="btn btn-sm roundedRight"><i class="fas fa-times"></i></a>
						</span>
					</div>
				</li>
				<?php
					$html = '';
					foreach ($list_logfile as $file) {
						$fsize = filesize('log/' . $file);
						if ($fsize < 2) {
							$fsizelog = '';
						} else if ($fsize < 1024) {
							$fsizelog = $fsize.' o';
						} else if ( $fsize < 1048576) {
							$fsizelog = round($fsize / 1024,1) .' Ko';
						} else {
							$fsizelog = round($fsize / 1048576 ,1) .' Mo';
						}
						if ($fsizelog != '') {
							$fsizelog = ' ('.$fsizelog.')';
						}
						$flag = '<i class="fa fa-check"></i>';
						if (shell_exec('grep -ci -E "\[:error\]|\[error\]" ' . __DIR__ . '/../../log/' . $file) != 0) {
							$flag = '<i class="fa fa-exclamation-triangle"></i>';
						} else if (shell_exec('grep -c -E "\[WARNING\]" ' . __DIR__ . '/../../log/' . $file) != 0) {
							$flag = '<i class="fa fa-exclamation-circle"></i>';
						}
						$html .= '<li class="cursor li_log" data-log="' . $file . '" ><a>' . $flag . ' ' . $file . $fsizelog . '</a></li>';
					}
					echo $html;
				?>
			</ul>
		</div>
	</div>
	<div class="col-lg-10 col-md-9 col-sm-8">
		<div class="input-group pull-right">
			<span class="input-group-btn" style="display: inline;">
				<span class="label-sm"> {{Log brut}}</span>
				<input type="checkbox" id="brutlogcheck" autoswitch="1"/>
				<i id="brutlogicon" class="fas fa-exclamation-circle icon_orange"></i>
				<input class="input-sm roundedLeft" id="in_searchGlobalLog" style="width : 200px;margin-left:5px;" placeholder="{{Rechercher}}" />
				<a id="bt_resetGlobalLogSearch" class="btn btn-sm"><i class="fas fa-times"></i></a>
				<a class="btn btn-warning btn-sm" data-state="1" id="bt_globalLogStopStart"><i class="fas fa-pause"></i> {{Pause}}
				</a><a class="btn btn-success btn-sm" id="bt_downloadLog"><i class="fas fa-cloud-download-alt"></i> {{Télécharger}}
				</a><a class="btn btn-warning btn-sm" id="bt_clearLog"><i class="fas fa-times"></i> {{Vider}}
				</a><a class="btn btn-danger btn-sm" id="bt_removeLog"><i class="far fa-trash-alt"></i> {{Supprimer}}
				</a><a class="btn btn-danger btn-sm roundedRight" id="bt_removeAllLog"><i class="far fa-trash-alt"></i> {{Supprimer tous}}</a>
			</span>
		</div>
		<pre id='pre_globallog' style='overflow: auto; height: calc(100% - 50px);width:100%;margin-top: 5px;'></pre>
	</div>
</div>

<?php include_file('desktop', 'log', 'js');?>
