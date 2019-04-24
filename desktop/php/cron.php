<?php
if (!isConnect('admin')) {
  throw new Exception('{{401 - Accès non autorisé}}');
}
?>

<br/>
<ul class="nav nav-tabs" role="tablist">
	<li role="presentation" class="active"><a href="#cron" role="tab" data-toggle="tab"><i class="fas fa-clock"></i> {{Cron}}</a></li>
	<li role="presentation"><a href="#listener" role="tab" data-toggle="tab"><i class="fas fa-assistive-listening-systems"></i> {{Listener}}</a></li>
	<li role="presentation"><a href="#deamon" role="tab" data-toggle="tab"><i class="fas fa-bug" ></i> {{Démon}}</a></li>
</ul>


<div class="tab-content">
  <div role="tabpanel" class="tab-pane active" id="cron">
	<div class="input-group pull-right" style="display:inline-flex">
	  <span class="input-group-btn">
		<?php
		if (config::byKey('enableCron') == 0) {
			echo '<a class="btn btn-success btn-sm roundedLeft" id="bt_changeCronState" data-state="1" style="margin-top: 5px;"><i class="fas fa-check"></i> {{Activer le système cron}}';
		} else {
			echo '<a class="btn btn-danger btn-sm roundedLeft" id="bt_changeCronState" data-state="0" style="margin-top: 5px;"><i class="fas fa-times"></i> {{Désactiver le système cron}}';
		}
		?>
		</a><a class="btn btn-sm" id="bt_refreshCron" style="margin-top: 5px;"><i class="fas fa-sync"></i> {{Rafraîchir}}
		</a><a class="btn btn-sm" id="bt_addCron" style="margin-top: 5px;"><i class="fas fa-plus-circle"></i> {{Ajouter}}
		</a><a class="btn btn-success roundedRight btn-sm" id="bt_save" style="margin-top: 5px;"><i class="far fa-check-circle"></i> {{Enregistrer}}</a>
		</span>
	</div>

	<br/><br/><br/>
	<table id="table_cron" class="table table-bordered table-condensed tablesorter">
		<thead>
			<tr>
				<th data-filter="false" data-resizable="false" class="id">{{ID}}</th>
				<th data-filter="false" data-sorter="checkbox" data-resizable="false" class="enable">{{Actif}}</th>
				<th data-filter="false" class="pid">{{PID}}</th>
				<th data-filter="false" data-sorter="checkbox" class="deamons">{{Démon}}</th>
				<th data-filter="false" data-sorter="checkbox" class="once">{{Unique}}</th>
				<th data-filter="false" data-sorter="input" class="class">{{Classe}}</th>
				<th data-filter="false" data-sorter="input" class="function">{{Fonction}}</th>
				<th data-filter="false" class="schedule">{{Programmation}} <i class="fas fa-question-circle cursor bt_pageHelp" data-name='cronSyntaxe' style="position: relative; width: 10px;"></i></th>
				<th data-filter="false" class="timeout">{{Timeout (min)}}</th>
				<th data-filter="false" class="lastRun">{{Dernier lancement}}</th>
				<th data-filter="false" class="runtime">{{Dernière durée}}</th>
				<th data-filter="false" class="state">{{Statut}}</th>
				<th data-filter="false" class="action">{{Actions}}</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
	</div>
	<div role="tabpanel" class="tab-pane" id="listener">
	<br/>
	<table id="table_listener" class="table table-bordered table-condensed" >
		<thead>
		<tr>
			<th style="width: 40px;">#</th>
			<th style="width: 80px;" data-sorter="false" data-filter="false"></th>
			<th>{{Event}}</th>
			<th style="width: 120px;">{{Classe}}</th>
			<th style="width: 120px;">{{Fonction}}</th>
		</tr>
		</thead>
		<tbody></tbody>
	</table>
	</div>

	<div role="tabpanel" class="tab-pane" id="deamon">
	<a class="btn btn-default pull-right" id="bt_refreshDeamon" style="margin-top: 5px;"><i class="fas fa-sync"></i> {{Rafraîchir}}</a>
	<br/><br/><br/>
	<table id="table_deamon" class="table table-bordered table-condensed" >
		<thead>
		<tr>
			<th>{{Nom}}</th>
			<th>{{Status}}</th>
			<th>{{Date lancement}}</th>
			<th>{{Action}}</th>
		</tr>
		</thead>
		<tbody></tbody>
	</table>
	</div>
</div>

<?php include_file('desktop', 'cron', 'js');?>
