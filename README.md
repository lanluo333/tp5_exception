tp5�Զ����쳣����:
==========================================
		��BaseException��ExceptionHandler��PHP�ļ�����app\api\libĿ¼�£�û������������������Ŀ¼���ǵ��޸��ļ�����������ռ�
		Ȼ����config.php�����ļ����exception_handle����ѡ��·���ĳ�ExceptionHandler��·��������:
		'exception_handle'       => 'app\lib\exception\ExceptionHandler',
		����أ�ÿ��ʹ�ò�ͬ���쳣��ʱ�򣬶����쳣�Ǹ�Ŀ¼�����½��쳣�������½�һ��ForbiddenException.php,�����̳�BaseException��
		����:
		<?php
		
		   namespace app\lib\exception;
		   
		   class ForbiddenException extends BaseException
		   {
		      public $code = 403;
		      public $msg = 'Ȩ�޲���';
		      public $errorCode = 10001;
		   }
		Ȼ�����׳��쳣��ʱ��,ֱ��throw new ForbiddenException(),�����׳�����һ���쳣:{'code':'403','msg':'Ȩ�޲���','10001'}
		��Ȼ���쳣��Ϣ�ʹ����붼�����Լ�����,����:
		throw new ForbiddenException([
		    'msg'=>'�㲻Ҫ���ſ��Է��ʣ�'
		]);
		��ô���쳣��Ϣ�ͻ�ĳ���Ӧ���޸ġ�

		��Ȼ�����������BaseValidate���Զ����һ����֤��application\api\validateĿ¼�£����û�У����½�Ŀ¼������������Ŀ¼���ǵ��޸�namespace��
		�ڴ��ļ���Ŀ¼�£��½���֤���������½�һ���ļ�IDMustBePostiveInt.php��������IDMustBePostiveInt��(�̳л�����֤��)�����������¶���:
	
		<?php
		
		namespace app\api\validate;

		class IDMustBePostiveInt extends BaseValidate
		{
			protected $rule = [
				'id' => 'require|isPostiveInteger',
			];

			protected $message = [
				'id' => 'id������������',
			];
		}

		Ȼ���ڿ������У�Ҫ����id����֤�Ļ���ֱ�� (new IDMustBePostiveInt())->goCheck();	�Ϳ��Խ�����֤��

