<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
    public  $layout=false;
    //使用layout如下格式
	//public $layout='//layouts/homeLayout';



	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();



    //Sx define
    public $theme="cerulean";
    public $title="";

    public  function init()
    {
        if ( isset($_SERVER["HTTP_ACCEPT"]) && stristr($_SERVER["HTTP_ACCEPT"],"application/json") ) {

            header("Content-Type: application/json;charset=utf-8");
        }else{
            header("Content-Type: text/html;charset=utf-8");
        }
    }

    /**
     * 不需要登陆就能调用的方法
     * @return array
     */
    public function noAuth()
    {
        return array(
            'login',
            'logout',
        );
    }

    public function filters()
    {
        return array(
            'loginAuth',
        );
    }

    /**
     * 判断是否需要登陆，并跳转到登陆页面
     * @param $filterChain
     */
    public function filterLoginAuth($filterChain)
    {
        if ( isset($this->getModule()->id) && ($this->getModule()->id=='admin') ){
            if (!in_array($this->action->id,$this->noAuth())){
                if (! Yii::app()->user->isLogined()){
                    $queryUrl=(empty($_SERVER["QUERY_STRING"])) ? "" : "&url=".urlencode(str_replace("r=","",$_SERVER["QUERY_STRING"]));
                    header("Location:".LOGIN_URL.$queryUrl);
                    die();
                }
            }
        }
        $filterChain->run();
    }
}




