{include file="header.tpl" section='account'}
{include file='lib/leftColumnIndex.tpl'}
<div id="rightContainer" style="width:75%">
{if $user->sex=='man'}
<fieldset>
<legend>Men Measurement</legend>
{if $user->measurement!=1}
Registering your measurement can make your purchase faster and smoother!<br />
You can also earn 20 reward points towards your future purchase!<br />
**You MUST all measurements for either men or women or both<br />
{else}
You may edit you measurement{/if}
<form id="measurementForm" method="post" action="{geturl action='uploadmeasurement'}?sex=men">
<table width="100%">
<tr>
<td>Name of Measurement:</td>
<td></td>
<td>Image</td>
<td>Video</td>
</tr>
<tr>
<td>
Body Height:</td><td> <input type="text" name="body_height" value="{$fp->body_height}" />cm</td>
</tr>
<tr>
<td>
Neck:</td><td>  <input type="text" name="neck" value="{$fp->neck}"/>cm</td><td><img src="/htdocs/css/images/men measurement/neck.jpg" height='24'/></td>
</tr>
<tr>
<td>
Chest:</td><td>  <input type="text" name="chest" value="{$fp->chest}"/>cm</td><td><img src="/htdocs/css/images/men measurement/chest.jpg" height='24'/></td>
</tr>
<tr>
<td>
Shoulder:</td><td>  <input type="text" name="shoulder" value="{$fp->shoulder}"/>cm</td><td><img src="/htdocs/css/images/men measurement/shoulder.jpg" height='24'/></td>
</tr>
<tr>
<td>
Armpit circumference:</td><td>  <input type="text" name="armpit_circumference" value="{$fp->armpit_circumference}"/>cm</td>
</tr>
<tr>
<td>
Arm length:</td><td>  <input type="text" name="arm_length" value="{$fp->arm_length}"/>cm</td><td><img src="/htdocs/css/images/men measurement/arm.jpg" height='24'/></td>
</tr>
<tr>
<td>
Shoulder to waist:</td><td> <input type="text" name="shoulder_to_waist" value="{$fp->shoulder_to_waist}"/>cm</td>
</tr>
<tr>
<td>
Waist: </td><td> <input type="text" name="waist" value="{$fp->waist}"/>cm</td><td><img src="/htdocs/css/images/men measurement/waist.jpg" height='24'/></td>
</tr>
<tr>
<td>
Hip: </td><td> <input type="text" name="hip" value="{$fp->hip}"/>cm</td><td><img src="/htdocs/css/images/men measurement/hip.jpg" height='24'/></td>
</tr>
<tr>
<td>
Thigh:</td><td> <input type="text" name="thigh" value="{$fp->thigh}"/>cm</td><td><img src="/htdocs/css/images/men measurement/thigh.jpg" height='24'/></td>
</tr>
<tr>
<td>
Length of pants: </td><td> <input type="text" name="length_pants" value="{$fp->length_pants}"/>cm</td><td><img src="/htdocs/css/images/men measurement/length_pants.jpg" height='24'/></td>
</tr>
<tr>
<td colspan="4" align="right">
<input type="submit" name="submit" value="Submit measurements" />
</td>
</tr>
</table>

</form>

</fieldset>
{elseif $user->sex=='woman'}
<fieldset>
<legend>Women Measurement</legend>
{if $user->measurement!=1}
Registering your measurement can make your purchase faster and smoother!<br />
You can also earn 20 reward points towards your future purchase!<br />
**You MUST all measurements for either men or women or both<br />
{else}
You may edit you measurement{/if}
<form id="measruemtnForm2" method="post" action="{geturl action='uploadmeasurement'}?sex=women">


<table width="100%">
<tr>
<td>Name of Measurement:</td>
<td></td>
<td>Image</td>
<td>Video</td>
</tr>
<tr>
<td>
Body Height:</td><td> <input type="text" name="body_height" value="{$fp->body_height}"/>cm</td>
</tr>
<tr>
<td>
Neck:</td><td>  <input type="text" name="neck" value="{$fp->neck}"/>cm</td><td><img src="/htdocs/css/images/women measurement/neck.jpg" height='24'/></td>
</tr>
<tr>
<td>
Chest:</td><td>  <input type="text" name="chest" value="{$fp->chest}"/>cm</td><td><img src="/htdocs/css/images/women measurement/chest.jpg" height='24'/></td>
</tr>
<tr>
<td>
Bust:</td><td>  <input type="text" name="bust" value="{$fp->bust}"/>cm</td><td><img src="/htdocs/css/images/women measurement/bust.jpg" height='24'/></td>
</tr>
<tr>
<td>
Bust point to bust point:</td><td>  <input type="text" name="bust_bust" value="{$fp->bust_bust}"/>cm</td><td><img src="/htdocs/css/images/women measurement/bust_bust.jpg" height='24'/></td>
</tr>

<tr>
<td>
Bust to waist:</td><td>  <input type="text" name="bust_waist" value="{$fp->bust_waist}"/>cm</td><td><img src="/htdocs/css/images/women measurement/bust_waist.jpg" height='24'/></td>
</tr>

<tr>
<td>
Shoulder:</td><td>  <input type="text" name="shoulder" value="{$fp->shoulder}"/>cm</td><td><img src="/htdocs/css/images/men measurement/shoulder_shoulder.jpg" height='24'/></td>
</tr>
<tr>
<td>
Shoulder to bust:</td><td>  <input type="text" name="shoulder_bust" value="{$fp->shoulder_bust}"/>cm</td><td><img src="/htdocs/css/images/women measurement/shoulder_bust.jpg" height='24'/></td>
</tr>
<tr>
<td>
Shoulder to waist:</td><td>  <input type="text" name="shoulder_to_waist" value="{$fp->shoulder_to_waist}"/>cm</td><td><img src="/htdocs/css/images/women measurement/shoulder_waist.jpg" height='24'/></td>
</tr>

<td>
Nape to waist:</td><td>  <input type="text" name="nape_waist" value="{$fp->nape_waist}"/>cm</td><td><img src="/htdocs/css/images/women measurement/nape_waist.jpg" height='24'/></td>
</tr>

<tr>
<td>
Armpit circumference:</td><td>  <input type="text" name="armpit_circumference" value="{$fp->armpit_circumference}"/>cm</td>
</tr>
<tr>
<td>
Arm length:</td><td>  <input type="text" name="arm_length" value="{$fp->arm_length}"/>cm</td><td><img src="/htdocs/css/images/women measurement/arm_outside.jpg" height='24'/></td>
</tr>

<tr>
<td>
Bicept:</td><td>  <input type="text" name="bicept" value="{$fp->bicept}"/>cm</td><td><img src="/htdocs/css/images/women measurement/bicept.jpg" height='24'/></td>
</tr>

<tr>
<td>
Wrist:</td><td>  <input type="text" name="wrist" value="{$fp->wrist}"/>cm</td><td><img src="/htdocs/css/images/women measurement/wrist.jpg" height='24'/></td>
</tr>

<tr>
<td>
Waist: </td><td> <input type="text" name="waist" value="{$fp->waist}"/>cm</td><td><img src="/htdocs/css/images/women measurement/waist.jpg" height='24'/></td>
</tr>
<tr>
<td>
Waist to floor: </td><td> <input type="text" name="waist_floor" value="{$fp->waist_floor}"/>cm</td><td><img src="/htdocs/css/images/women measurement/waist.jpg" height='24'/></td>
</tr>
<tr>
<td>
Hip: </td><td> <input type="text" name="hip" value="{$fp->hip}"/>cm</td><td><img src="/htdocs/css/images/women measurement/hip.jpg" height='24'/></td>
</tr>

<tr>
<td>
Crotch:</td><td>  <input type="text" name="crotch" value="{$fp->crotch}"/>cm</td><td><img src="/htdocs/css/images/women measurement/crotch.jpg" height='24'/></td>
</tr>


<tr>
<td colspan="4" align="right">
<input type="submit" name="submit" value="Submit measurements" />
</td>
</tr>
</table>

</form>
</fieldset>
{/if}
</div>

{include file="footer.tpl"}