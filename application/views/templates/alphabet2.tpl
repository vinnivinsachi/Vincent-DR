<div class="alphabet" style="height: 20px; padding-right: 10px; padding-top:10px;">
	
	
	{if $currentTotalPage>0}
		<div id="pageSeparator" style="float:right;">
		
				{if $currentPage !=1}

				<a href="{if $currentAlphabet}
							{$alphabetLink.$currentAlphabet}&limitPage=1
						{else}
							{$paginationLink}?limitPage=1
						{/if}
						
						"> first</a>
				
				<a href="{if $currentAlphabet}
							{$alphabetLink.$currentAlphabet}&limitPage={$currentPage-1}
						{else}
							{$paginationLink}?limitPage={$currentPage-1}
						{/if}
						
						"> previous</a>
				{/if}
				
				
				
				{if ($currentPage-3) >0}
				<a href="{if $currentAlphabet}
							{$alphabetLink.$currentAlphabet}&limitPage={$currentPage-3}
						{else}
							{$paginationLink}?limitPage={$currentPage-3}
						{/if}
						
						"> {$currentPage-3}</a>
				{/if}
				
			
				{if ($currentPage-2) >0}
				<a href="{if $currentAlphabet}
							{$alphabetLink.$currentAlphabet}&limitPage={$currentPage-2}
						{else}
							{$paginationLink}?limitPage={$currentPage-2}
						{/if}
						
						"> {$currentPage-2}</a>
				{/if}
				
				
				{if ($currentPage-1) >0 }
				<a href="{if $currentAlphabet}
							{$alphabetLink.$currentAlphabet}&limitPage={$currentPage-1}
						{else}
							{$paginationLink}?limitPage={$currentPage-1}
						{/if}
						
						"> {$currentPage-1}</a>
				{/if}
				
				
				<span style="font-weight:bold;">{$currentPage} </span>
				
				{if ($currentPage+1) <= $currentTotalPage}
				<a href="{if $currentAlphabet}
							{$alphabetLink.$currentAlphabet}&limitPage={$currentPage+1}
						{else}
							{$paginationLink}?limitPage={$currentPage+1}
						{/if}
						
						"> {$currentPage+1}</a>
				{/if}
				
				{if ($currentPage+2) <= $currentTotalPage}
				<a href="{if $currentAlphabet}
							{$alphabetLink.$currentAlphabet}&limitPage={$currentPage+2}
						{else}
							{$paginationLink}?limitPage={$currentPage+2}
						{/if}
						
						"> {$currentPage+2}</a>
				{/if}
				
				{if ($currentPage+3) <= $currentTotalPage}
					<a href="{if $currentAlphabet}
							{$alphabetLink.$currentAlphabet}&limitPage={$currentPage+3}
						{else}
							{$paginationLink}?limitPage={$currentPage+3}
						{/if}
						
						"> {$currentPage+3}</a>
				{/if}
				
				
				{if $currentTotalPage!=$currentPage}
				<a href="{if $currentAlphabet}
							{$alphabetLink.$currentAlphabet}&limitPage={$currentPage+1}
						{else}
							{$paginationLink}?limitPage={$currentPage+1}
						{/if}
						
						"> next</a>
				
				
				<a href="{if $currentAlphabet}
							{$alphabetLink.$currentAlphabet}&limitPage={$currentTotalPage}
						{else}
							{$paginationLink}?limitPage={$currentTotalPage}
						{/if}
						
						"> last</a>
				{/if}
		</div>
	{/if}

</div>