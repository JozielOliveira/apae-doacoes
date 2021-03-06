<div class="well">
	<div class="">
		<div class="page-header">
			<h2>Bancos</h2>
			<a class="btn btn-success" href="<?= site_url('banks/add');?>"><span class="glyphicon glyphicon-plus"></span> Cadastrar Banco</a>
		</div>
		<?= $this->session->flashdata('alert') ?>
		<table class="table table-responsive table-hover">
			<thead>
				<tr>
					<th>Código</th>
					<th>Nome</th>
					<th>Telefone</th>
					<th>Agência</th>
					<th>DV</th>
					<th>Conta Corrente</th>
					<th>DV</th>
				</tr>
			</thead>
			<tbody>
			<?php
				if(count($banks)>=1){
				foreach($banks as $bank){
			?>
				<tr>
					<td><?= $bank['id_bank'];?> </td>
					<td><?= $bank['name_bank']; ?></td>
					<td><?= $bank['phone_bank']; ?></td>
					<td><?= $bank['agency_number']; ?></td>
					<td><?= $bank['check_digit_agency']; ?></td>
					<td><?= $bank['account_number']; ?></td>
					<td><?= $bank['check_digit_account']; ?></td>
					<td>
						<div class="btn-group">
							<a class="btn btn-primary btn-sm" href="<?= site_url('banks/edit')."/".$bank['id_bank'];?>"><span class="glyphicon glyphicon-edit"></span></a>
							<a data-model="<?=$bank['id_bank']?>" data-toggle="modal" data-target="#delete_modal" type="button" class="btn btn-danger btn-sm" ><span class="glyphicon glyphicon-trash"></span></a>
						</div>
					</td>
				</tr>
			<?php
				}
			}
			?>
			</tbody>
		</table>
	</div>
</div>

<div class="modal fade" id="delete_modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Confirmar Exclusão</h4>
			</div>
			<div class="modal-body">
				<p>Tem certeza que deseja apagar este Banco?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</button>
				<a data-dismiss="modal" id="confirmDelete" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Apagar</a>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	(function() {
		var id, button;
		$('#delete_modal').on('show.bs.modal', function(e) {
			button = $(e.relatedTarget);
			id = button.data('model');
		})
		$('#confirmDelete').on('click', function() {
			/*$.ajax({
				url: 'banks/delete/'+id,
				type: 'POST',
				success: function(data) {
					$(button).closest('tr').remove();
				},
				error: function(err) {
					$('.toast').text("Erro de violação de integridade de dados!").fadeIn(400).delay(3000).fadeOut(400);

				}
			});*/
			window.location.href = "banks/delete/"+ id;
		})
	})();
</script>

<script type="text/javascript">

	var id, button, nome;

	$('#modalExcluirDoar').on('show.bs.modal', function(e) {
		button = $(e.relatedTarget);
		id = button.data('petid');
		nome = button.data('petnome');
		console.warn('O pet que eu quero excluir tem id ', id , 'e nome:', nome);
		$("#testando").text("Texto q eu quero substituir com o nome do pet que é " + nome);
	});

	$('#confirmaExcluirPet').on('click', function() {
		window.location.href = "<?= base_url('excluirAnimal') ?>"+ "/" + id;
	});
</script>
