tp5自定义异常处理:
==========================================
		把BaseException和ExceptionHandler的PHP文件放入app\api\lib目录下，没有则建立。如果想放入别的目录，记得修改文件里面的命名空间
		然后，在config.php配置文件里，把exception_handle配置选项路径改成ExceptionHandler的路径，例如:
		'exception_handle'       => 'app\lib\exception\ExceptionHandler',
		最后呢，每次使用不同的异常的时候，都在异常那个目录那里新建异常，例如新建一个ForbiddenException.php,这个类继承BaseException。
		如下:
		<?php
		
		   namespace app\lib\exception;
		   
		   class ForbiddenException extends BaseException
		   {
		      public $code = 403;
		      public $msg = '权限不够';
		      public $errorCode = 10001;
		   }
		然后在抛出异常的时候,直接throw new ForbiddenException(),就能抛出形如一下异常:{'code':'403','msg':'权限不够','10001'}
		当然，异常信息和错误码都可以自己定义,例如:
		throw new ForbiddenException([
		    'msg'=>'你不要想着可以访问！'
		]);
		那么，异常信息就会改成相应的修改。

		当然，我们这里的BaseValidate是自定义的一个验证，application\api\validate目录下，如果没有，则新建目录，如果不想放这目录，记得修改namespace。
		在此文件的目录下，新建验证器，例如新建一个文件IDMustBePostiveInt.php，里面是IDMustBePostiveInt类(继承基类验证器)，在类中如下定义:
	
		<?php
		
		namespace app\api\validate;

		class IDMustBePostiveInt extends BaseValidate
		{
			protected $rule = [
				'id' => 'require|isPostiveInteger',
			];

			protected $message = [
				'id' => 'id必须是正整数',
			];
		}

		然后在控制器中，要进行id的验证的话，直接 (new IDMustBePostiveInt())->goCheck();	就可以进行验证。

