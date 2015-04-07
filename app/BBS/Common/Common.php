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
    public static function encodeTopicContent($content)
    {
      return preg_replace('/script/i','"script"',$content);
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