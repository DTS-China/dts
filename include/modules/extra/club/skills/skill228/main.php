<?php

namespace skill228
{

	function init() 
	{
		define('MOD_SKILL228_INFO','club;battle;');
		eval(import_module('clubbase'));
		$clubskillname[228] = '神击';
	}
	
	function acquire228(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
	}
	
	function lost228(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
	}
	
	function check_unlocked228(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		return $pa['lvl']>=15;
	}
	
	function skill_onload_event(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		$chprocess($pa);
	}
	
	function skill_onsave_event(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		$chprocess($pa);
	}
	
	function get_rage_cost228(&$pa = NULL)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		return 100;
	}
	
	function strike_prepare(&$pa, &$pd, $active)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		if ($pa['bskill']!=228) return $chprocess($pa, $pd, $active);
		if (!\skillbase\skill_query(228,$pa) || !check_unlocked228($pa))
		{
			eval(import_module('logger'));
			$log .= '你尚未解锁这个技能！';
			$pa['bskill']=0;
		}
		else
		{
			$rcost = get_rage_cost228($pa);
			if ($pa['rage']>=$rcost)
			{
				eval(import_module('logger'));
				if ($active)
					$log.="<span class=\"lime\">你对{$pd['name']}发动了技能「神击」！</span><br>";
				else  $log.="<span class=\"lime\">{$pa['name']}对你发动了技能「神击」！</span><br>";
				$pa['rage']-=$rcost;
				addnews ( 0, 'bskill228', $pa['name'], $pd['name'] );
			}else if ($pa['skillpoint']>=5){
				eval(import_module('logger'));
				if ($active)
					$log.="<span class=\"lime\">你对{$pd['name']}发动了技能「神击」！</span><br>";
				else  $log.="<span class=\"lime\">{$pa['name']}对你发动了技能「神击」！</span><br>";
				$pa['skillpoint']-=5;
				addnews ( 0, 'bskill228', $pa['name'], $pd['name'] );
			}else
			{
				if ($active)
				{
					eval(import_module('logger'));
					$log.='怒气不足或其他原因不能发动。<br>';
				}
				$pa['bskill']=0;
			}
		}
		$chprocess($pa, $pd, $active);
	}	
	
	function get_final_dmg_multiplier(&$pa, &$pd, $active)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		$r=Array();
		if ($pa['bskill']==228) 
		{
			eval(import_module('logger'));
			if ($active)
				$log.='<span class="lime">你有如天神下凡，对敌人打出雷霆一击！</span><br>';
			else  $log.='<span class="lime">敌人有如天神下凡，对你打出雷霆一击！</span><br>';
			$r=Array(1.6);
		}
		return array_merge($r,$chprocess($pa,$pd,$active));
	}
	
	function parse_news($news, $hour, $min, $sec, $a, $b, $c, $d, $e)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		
		eval(import_module('sys','player'));
		
		if($news == 'bskill228') 
			return "<li>{$hour}时{$min}分{$sec}秒，<span class=\"clan\">{$a}对{$b}发动了技能<span class=\"yellow\">「神击」</span></span><br>\n";
		
		return $chprocess($news, $hour, $min, $sec, $a, $b, $c, $d, $e);
	}
}

?>
