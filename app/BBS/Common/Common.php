<?php
/**
 *  Common类用于提供常用的自定义方法
 */
namespace App\BBS\Common;

class Common {

	//日时间戳
	protected static $dayTimestamp = 86400;

    //时时间戳
    protected static $hourTimestamp = 3600;

    //月时间戳
   protected static $monthTimestamp = 259200;

   //年时间戳
    protected static $yearTimestamp = 315360000;
    //分时间戳
    protected static $minutesTimestamp = 60;
	/**
	 *  计算发帖回帖距离当前的时间
	 * @param  [type] $time [description]
	 * @return [type]       [description]
	 */
	public static function calculateTopicTime($time)
	{
		$result = '';
		if ($time > self::$yearTimestamp) {
			$result = floor($time / self::$yearTimestamp)." 年";
		}
		else if ($time > self::$monthTimestamp) {
			$result = floor($time / self::$monthTimestamp)." 个月";
		}
		else if ($time > self::$dayTimestamp) {
            $result = floor($time / self::$dayTimestamp)." 天";
		}
		else if ($time > self::$hourTimestamp) {
            $result = floor($time / self::$hourTimestamp)." 小时";
		}
		else if ($time > self::$minutesTimestamp) {
             $result = floor($time / self::$minutesTimestamp)." 分钟";
		}
		else {
			return $time."秒";
		}
		return $result;
    }
    /**
     * [encodeTopicContent description]
     * @return [type] [description]
     */
    public static function encodeTopicContent($info)
    {
      $info = str_replace("script","**script**;",$info);
      $info = preg_replace('/(<\w+\s+\w+>)/i', "->$1<-", $info);
      $rndID = "rndID".ceil( 10000 * rand() );
      $info = str_replace("\t","",$info);
      // $info = str_replace("<","&lt;",$info);
      // $info = str_replace(">","&gt;",$info);
      $info = str_replace("\r","<br />",$info);
      $info = str_replace("\n\n","</p><p>",$info);
      $info = str_replace("\n","",$info);
      $info = str_replace("|","│",$info);
      $info = str_replace("  "," &nbsp;",$info);
      $info = str_replace("\\\"","\"",$info);
      $info = str_replace('\\\'','\'',$info);

      $info = str_replace("<p>","<br /><br />",$info);
      $info = str_replace("<br>"," <br />",$info);
      $info = str_replace("[u]","<u>",$info);
      $info = str_replace("[/u]","</u>",$info);
      $info = str_replace("[b]","<b>",$info);
      $info = str_replace("[/b]","</b>",$info);
      $info = str_replace("[i]","<i>",$info);
      $info = str_replace("[/i]","</i>",$info);
      $info = str_replace("[br]","<br />",$info);
      $info = str_replace("[list]","<ul>",$info);
      $info = str_replace("[/list]","</ul>",$info);
      $info = str_replace("[olist]","<ol>",$info);
      $info = str_replace("[/olist]","</ol>",$info);
      $info = str_replace("[*]","<li>",$info);
      $info = str_replace("[hr]","<hr width=40% align=left>",$info);
      $info = str_replace("[sup]","<sup>",$info);
      $info = str_replace("[/sup]","</sup>",$info);
      $info = str_replace('[url=&quot;','[url="',$info);
      $info = str_replace('&quot;]','"]',$info);

      $pattern = array(
        "/\[folder=([^\[]*)\](.+?)\[\/folder\]/is",
        "/\[font=([^\[]*)\](.+?)\[\/font\]/is",
        "/\[color=([#0-9a-z]{1,10})\](.+?)\[\/color\]/is",
        "/\[email=([^\[]*)\](.+?)\[\/email\]/is",
        "/\[email\]([^\[]*)\[\/email\]/is",
        "/\[url=([^\[]*)\](.+?)\[\/url\]/is",
        "/\[url\]www\.([^\[]*)\[\/url\]/is",
        "/\[url\]([^\[]*)\[\/url\]/is",
        "/\[quote\]\s*(.*?)\s*\[\/quote\]/is",
        "/(\[fly\])(.+?)(\[\/fly\])/is",
        "/(\[move\])(.+?)(\[\/move\])/is",
        "/(\[align=)(left|center|right)(\])(.+?)(\[\/align\])/is",
        "/(\[shadow=)(\S+?)(\,)(.+?)(\,)(.+?)(\])(.+?)(\[\/shadow\])/is",
        "/(\[glow=)(\S+?)(\,)(.+?)(\,)(.+?)(\])(.+?)(\[\/glow\])/is",
        "/\[code\](.+?)\[\/code\]/is"
        );
      
      $replacement = array(
        "<div style=\"border:1px dotted #8394B2;border-left:4px solid #8394B2;background:#FAFCFE\"><div style=\"background:#E4EAF2;padding:3px;font-weight:bold\"><img src=\"../images/me.gif\"> \\1</div><div style=\"padding:6px\"><a href=\"javascript:hidden(".$rndID.");\"><span style=\"font-size: 12px;\">&gt;&gt;&gt; 打开/隐藏内容</span></a><div id=\"".$rndID."\" style=\"overflow:hidden;display:none\"><div>\\2</div></div></div></div>",
        "<font face=\"\\1\">\\2</font>",
        "<font color=\"\\1\">\\2</font>",
        "<a href=\"mailto:\\1\">\\2</a>",
        "<a href=\"mailto:\\1\">\\1</a>",
        "<a href=\"\\1\" target=_blank>\\2</a>",
        "<a href=\"http://www.\\1\" target=_blank>\\1</a>",
        "<a href=\"\\1\" target=_blank>\\1</a>",
        "<table cellpadding=0 cellspacing=0 border=0 WIDTH=94% bgcolor=#000000 align=center><tr><td><table width=100% cellpadding=5 cellspacing=1 border=0><TR><TD BGCOLOR=#F4F4F4 class=quotecontent>\\1</table></table>",
        "<marquee width=90% behavior=alternate scrollamount=3>\\2</marquee>",
        "<MARQUEE scrollamount=3>\\2</MARQUEE>",
        "<DIV Align=\\2>\\4</DIV>",
        "<table width=\\2 style=\"filter:shadow(color=\\4, direction=\\6 ,strength=2)\">\\8</table>",
        "<table width=\\2 style=\"filter:glow(color=\\4, strength=\\6)\">\\8</table>",
        "<table border=0 width=95% align=center cellpadding=2 bgcolor=DDDDDF><tr><td><pre><font face='Courier New'>\\1</font></pre></td></tr></table>",
        );
      
      $info = preg_replace($pattern,$replacement,$info);

      return $info;
    }
   /**
    * [dealReplyContent description]
    * @return [type] [description]
    */
    public static function dealReplyContent($array)
    {
      $new = [];

      foreach ($array as $key => $value) {
      	$value = substr($value,1);
      	if (!in_array($value, $new)){
      		array_push($new,$value);
      	}
      }

      return $new;
    }
    /**
     * [compareAndCombine description]
     * @return [type] [description]
     */
    public static function compareAndCombine($array1,$array2)
    {
      $new = [];

      foreach ($array1 as $key => $value) {
      	if(in_array($value, $array2))
      		 $new[] = $value;
      }

      return $new;
    }
}