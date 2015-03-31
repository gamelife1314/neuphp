<?php
/**
 *  Common类用于提供常用的自定义方法
 */
namespace App\BBS\Common;

class Common {

	//日时间戳
	static $dayTimestamp = 86400;

    //时时间戳
    static $hourTimestamp = 3600;

    //月时间戳
   static $monthTimestamp = 259200;

   //年时间戳
    static $yearTimestamp = 315360000;
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
            $result = floor($time / self::$dayTimestamp)." 日";
		}
		else if ($time > self::$hourTimestamp) {
            $result = floor($time / self::$hourTimestamp)." 小时";
		}
		return $result;
    }
}