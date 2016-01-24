<table class="table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr>
			{foreach columns as colum}
				<th>{colum}</th>
			{/foreach}
		</tr>
	</thead>
	{if self.footer}
		<tfoot>
			<tr>
				{foreach columns as colum}
					<th>{colum}</th>
				{/foreach}
			</tr>
		</tfoot>
	{/if}
	<tbody>
		<tr>
		{foreach rows as row}
			{foreach columns as colum}
				<td>{row[_key]}</td>
			{/foreach}
		{/foreach}
		</tr>
	</tbody>
</table>
