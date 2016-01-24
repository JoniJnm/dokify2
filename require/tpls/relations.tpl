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
		{foreach rows as row}
			<tr>
				{foreach columns as colum}
					<td>{row[_key]}</td>
				{/foreach}
			</tr>
		{/foreach}
	</tbody>
</table>
