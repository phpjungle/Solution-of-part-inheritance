<?php
/**
 * 运行时继承-子类部分/完全调用继承方法的实现
 * Runtime inheritance - The solution of part inheritance
 * 
 * @author PHPJungle
 * @since 2015/06/23 周二
 * @abstract <pre>
 * 	需求:
 *  Demand:
 * 		由于需求的变动，在继承层次比较多的情况下，有时候只需要修改父类某个行为的部分方法ACT1(ACT1方法已被多个子类继承)，
 * 	但又不希望影响子类的原有行为，如何解决该问题？
 * 		Due to changes in demand, and in more cases inheritance hierarchy, sometimes we only need to change some of the ways the behavior of a parent method ACT1 (ACT1 method has been inherited by some subclasses)
 *  But we do not want to influence the behavior of the original sub-class, how to solve this problem?
 * 
 * 	方案:
 * 	My Solution:
 * 		判断执行方法ACT1的对象是父类还是子类的实例，然后做一个分支即可。
 * 		We need to judge who did this action,the son' object  or the parent's object? Then add a branch.
 * 		
 *  工具:使用函数 get_class @see http://www.php.net/manual/en/function.get-class.php
 *  Tools: Use function get_class @see http://www.php.net/manual/en/function.get-class.php
 *  
 * </pre>
 */

/**
 * 案例:子类继承了父亲的行为，但只有执行部分代码的权限，但父类有完全执行权限
 * Demo:
 * 
 * @author PHPJungle
 * @since 2015/06/23 周二
 *       
 */
class Base {
	public function pay_money() {
		# [Step-1:do_check]
		$this->do_check ();
		$_CLASS = get_class ( $this ); // 默认传递的是NULL

		# [Step-2:do_pay &&  CHECK_ROLE]
		if (__CLASS__ === $_CLASS) {
			$this->do_pay ();
		} else {
			echo 'No permission to do-pay!', PHP_EOL, '<hr>';
		}
		return ;
	}
	
	private function do_check() {
		echo 'Checking money,please waiting!', PHP_EOL, '<hr>';
		return;
	}
	
	private function do_pay() {
		echo 'Pay success!', PHP_EOL, '<hr>';
		return;
	}
}

class Son extends Base {
}

$base = new Base ();
$son = new Son ();

$base->pay_money ();
$son->pay_money ();

# [Outputs like this]
# 以上例程输出：@2015/06/23 周二

// Checking money,please waiting!
// Pay success!
// Checking money,please waiting!
// No permission to do-pay!
