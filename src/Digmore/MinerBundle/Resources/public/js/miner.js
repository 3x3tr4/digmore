/**
 * miner.js
 * 
 *  @j
 */

function show_miner_controls(id)
{
	el = $('#miner-controls-'+id);
	if (el.css('display')=='block')
	{
		el.css('display', 'none');
	} else {
		el.css('display', 'block');
	}
	
}
