<div class="alphabet" style="height: 20px;">
	<div style="float:left;">
	
	<a href="{$alphabetLink.a}" {if $currentAlphabet=='a'} class="alphabetSelected"{/if}>A</a>
	<a href="{$alphabetLink.b}" {if $currentAlphabet=='b'} class="alphabetSelected"{/if}>B</a>
	<a href="{$alphabetLink.c}" {if $currentAlphabet=='c'} class="alphabetSelected"{/if}>C</a>
	<a href="{$alphabetLink.d}" {if $currentAlphabet=='d'} class="alphabetSelected"{/if}>D</a>
	<a href="{$alphabetLink.e}" {if $currentAlphabet=='e'} class="alphabetSelected"{/if}>E</a>
	<a href="{$alphabetLink.f}" {if $currentAlphabet=='f'} class="alphabetSelected"{/if}>F</a>
	<a href="{$alphabetLink.g}" {if $currentAlphabet=='g'} class="alphabetSelected"{/if}>G</a>
	<a href="{$alphabetLink.h}" {if $currentAlphabet=='h'} class="alphabetSelected"{/if}>H</a>
	<a href="{$alphabetLink.i}" {if $currentAlphabet=='i'} class="alphabetSelected"{/if}>I</a>
	<a href="{$alphabetLink.j}" {if $currentAlphabet=='j'} class="alphabetSelected"{/if}>J</a>
	<a href="{$alphabetLink.k}" {if $currentAlphabet=='k'} class="alphabetSelected"{/if}>K</a>
	<a href="{$alphabetLink.l}" {if $currentAlphabet=='l'} class="alphabetSelected"{/if}>L</a>
	<a href="{$alphabetLink.m}" {if $currentAlphabet=='m'} class="alphabetSelected"{/if}>M</a>
	<a href="{$alphabetLink.n}" {if $currentAlphabet=='n'} class="alphabetSelected"{/if}>N</a>
	<a href="{$alphabetLink.o}" {if $currentAlphabet=='o'} class="alphabetSelected"{/if}>O</a>
	<a href="{$alphabetLink.p}" {if $currentAlphabet=='p'} class="alphabetSelected"{/if}>P</a>
	<a href="{$alphabetLink.q}" {if $currentAlphabet=='q'} class="alphabetSelected"{/if}>Q</a>
	<a href="{$alphabetLink.r}" {if $currentAlphabet=='r'} class="alphabetSelected"{/if}>R</a>
	<a href="{$alphabetLink.s}" {if $currentAlphabet=='s'} class="alphabetSelected"{/if}>S</a>
	<a href="{$alphabetLink.t}" {if $currentAlphabet=='t'} class="alphabetSelected"{/if}>T</a>
	<a href="{$alphabetLink.u}" {if $currentAlphabet=='u'} class="alphabetSelected"{/if}>U</a>
	<a href="{$alphabetLink.v}" {if $currentAlphabet=='v'} class="alphabetSelected"{/if}>V</a>
	<a href="{$alphabetLink.w}" {if $currentAlphabet=='w'} class="alphabetSelected"{/if}>W</a>
	<a href="{$alphabetLink.x}" {if $currentAlphabet=='x'} class="alphabetSelected"{/if}>X</a>
	<a href="{$alphabetLink.y}" {if $currentAlphabet=='y'} class="alphabetSelected"{/if}>Y</a>
	<a href="{$alphabetLink.z}" {if $currentAlphabet=='z'} class="alphabetSelected"{/if}>Z</a>

	</div>
	
	
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