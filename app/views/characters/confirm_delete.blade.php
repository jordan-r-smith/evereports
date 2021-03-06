<!-- Modal Dialog -->
<div class="modal fade" id="confirmDelete" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title">Remove API key</h4>
			</div>
			<div class="modal-body">
				<p>
					Are you sure you want to remove this API key?
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Cancel
				</button>
				<button type="button" class="btn btn-danger" id="confirm">
					Remove
				</button>
			</div>
		</div>
	</div>
</div>

<!-- Dialog show event handler -->
<script type="text/javascript">
	$('#confirmDelete').on('show.bs.modal', function(e) {
		$url = $(e.relatedTarget).attr('data-url');
		$('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
			window.location = $url;
		});
	});
</script>