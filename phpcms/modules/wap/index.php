<?php 
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_app_func('global');
pc_base::load_sys_class('format', '', 0);
class index {

	const industry =array(
		'A'=> '农、林、牧、渔业',
		'B'=> '采矿业',
		'C'=> '制造业',
		'D'=> '电力、热力、燃气及水生产和供应业',
		'E'=> '建筑业',
		'F'=> '批发和零售业',
		'G'=> '交通运输、仓储和邮政业',
		'H'=> '住宿和餐饮业',
		'I'=> '信息传输、软件和信息技术服务业',
		'J'=> '金融业',
		'K'=> '房地产业',
		'L'=> '租赁和商务服务业',
		'M'=> '科学研究和技术服务业',
		'N'=> '水利、环境和公共设施管理业',
		'O'=> '居民服务、修理和其他服务业',
		'P'=> '教育',
		'Q'=> '卫生和社会工作',
		'R'=> '文化、体育和娱乐业',
		'S'=> '公共管理、社会保障和社会组织',
		'T'=> '国际组织',
	);

	const credit=array(
		'1'=>'AAA',
		'2'=>'AA',
		'3'=>'A',
		'4'=>'BBB',
		'5'=>'BB',
		'6'=>'B',
		'7'=>'CCC',
		'8'=>'CC',
		'9'=>'C',

	);

	const natur=array(
		'1'=>'国有企业',
		'2'=>'集体企业',
		'3'=>'股份合作企业',
		'4'=>'联营企业',
		'5'=>'外商投资企业',
		'6'=>'私营企业',
		'7'=>'股份有限公司',
		'8'=>'有限责任公司',
		'9'=>'中外合资企业（中方控股50%以上）',
		'10'=>'上市企业（或上市企业控股50%以上）',
	);

	const qualifications=array(
		'1'=>'国家高新技术企业',
		'2'=>'中关村高新企业',
		'3'=>'信息系统集成及服务',
		'4'=>'涉密计算机系统集成',
		'5'=>'ISO9000质量管理体系认证',
		'6'=>'ISO14000环境管理体系标准认证',
		'7'=>'其他',
	);

	const features=array(
		'1'=>'承担过国家科技计划，并得到经费支持',
		'2'=>'产学研合作',
		'3'=>'高校或科研院所办的企业',
		'4'=>'留学人员办的企业',
		'5'=>'国家高新区内的企业',
		'6'=>'国家创业服务中心内的企业',
		'7'=>'其他',
	);

	const business_model=array(
		'1'=>'生产制造（研究、开发、生产、销售）',
		'2'=>'技术交易（服务、开发、转让）',
		'3'=>'选项连锁经营',
		'4'=>'其他',
	);



	function __construct() {		
		$this->db = pc_base::load_model('content_model');
		$this->siteid = isset($_GET['siteid']) && (intval($_GET['siteid']) > 0) ? intval(trim($_GET['siteid'])) : (param::get_cookie('siteid') ? param::get_cookie('siteid') : 1);
		param::set_cookie('siteid',$this->siteid);	
		$this->wap_site = getcache('wap_site','wap');
		$this->types = getcache('wap_type','wap');
		$this->wap = $this->wap_site[$this->siteid];
		define('WAP_SITEURL', $this->wap['domain'] ? $this->wap['domain'].'index.php?' : APP_PATH.'index.php?m=wap&siteid='.$this->siteid);
		if($this->wap['status']!=1) exit(L('wap_close_status'));
	}
	
	//展示首页
	public function init() {
		$WAP = $this->wap;
		$TYPE = $this->types;
		$WAP_SETTING = string2array($WAP['setting']);
		$GLOBALS['siteid'] = $siteid = max($this->siteid,1);
		$template = $WAP_SETTING['index_template'] ? $WAP_SETTING['index_template'] : 'index';
		include template('wap', $template);
	}

	//展示首页
	public function policy() {
		$WAP = $this->wap;
		$TYPE = $this->types;
		$WAP_SETTING = string2array($WAP['setting']);
		$GLOBALS['siteid'] = $siteid = max($this->siteid,1);
		include template('wap', 'policy');
	}

	//展示列表页
	public function jsonlists() {
		$json = isset($_GET['json']) && $_GET['json'] ? $_GET['json'] : false;
		$parentids = array();
		$WAP = $this->wap;
		$TYPE = $this->types;
		$WAP_SETTING = string2array($WAP['setting']);
		$GLOBALS['siteid'] = $siteid = max($this->siteid,1);
		$typeid = intval($_GET['typeid']);
		if(!$typeid) exit(L('parameter_error'));
		$subtype=subtype($typeid);
		$catids=array();
		$catnames=array();
		foreach($subtype as $k=>$v){
			$catnames[$v['cat']]=$v['typename'];
			$catids[]=$v['cat'];
		}

		$catid = $this->types[$typeid]['cat'];
		$siteids = getcache('category_content','commons');
		$siteid = $siteids[$catid];
		$CATEGORYS = getcache('category_content_'.$siteid,'commons');
		if(!isset($CATEGORYS[$catid])) exit(L('parameter_error'));
		$CAT = $CATEGORYS[$catid];
		$siteid = $GLOBALS['siteid'] = $CAT['siteid'];
		extract($CAT);
		foreach($TYPE as $_t) $parentids[] = $_t['parentid'];
		$template = ($TYPE[$typeid]['parentid']==0 && in_array($typeid,array_unique($parentids))) ? $WAP_SETTING['category_template'] : $WAP_SETTING['list_template'];
		$MODEL = getcache('model','commons');
		$modelid = $CAT['modelid'];

		$tablename = $this->db->table_name = $this->db->db_tablepre.$MODEL[$modelid]['tablename'];
		$total = $this->db->count('status=99 and catid in ('.implode(',',$catids).')');
		$page = isset($_GET['page']) && intval($_GET['page']) ? intval($_GET['page']) : 1;
		$pagesize = $WAP_SETTING['listnum'] ? intval($WAP_SETTING['listnum']) : 20 ;
		$offset = ($page - 1) * $pagesize;
		$list = $this->db->select('status=99 and catid in ('.implode(',',$catids).')', '*', $offset.','.$pagesize,'inputtime DESC');
		//echo $this->db->lastsql();
	//print_r($list);
		if($json){
			$data=array();
			$class=array('21'=>1,'22'=>2);
			foreach($list as $k=>$v){
				$data[$k]['id']=$v['id'];
				$data[$k]['title']=$v['title'];
				$data[$k]['status']=$v['id'];
				$data[$k]['created']=$v['inputtime'].'000';
				$data[$k]['url']=show_url($v['catid'],$v['id']);
				$data[$k]['category']=array('title'=>$catnames[$v['catid']],'num'=>$class[$v['catid']]);
			}
			$data['data']=$data;
			$data['meta']['total']=$total;
			$data['meta']['start']=$page;
			$data['meta']['size']=$pagesize;
			echo json_encode($data);exit;
		}
	}
	
    //展示列表页
	public function lists() {
		$json = isset($_GET['json']) && $_GET['json'] ? $_GET['json'] : false;
	    $parentids = array();
		$WAP = $this->wap;
		$TYPE = $this->types;
		$WAP_SETTING = string2array($WAP['setting']);
		$GLOBALS['siteid'] = $siteid = max($this->siteid,1);
		$typeid = intval($_GET['typeid']);

		$a=subtype($typeid);

		if(!$typeid) exit(L('parameter_error'));
		$catid = $this->types[$typeid]['cat'];	
		$siteids = getcache('category_content','commons');
		$siteid = $siteids[$catid];
		$CATEGORYS = getcache('category_content_'.$siteid,'commons');
		if(!isset($CATEGORYS[$catid])) exit(L('parameter_error'));
		$CAT = $CATEGORYS[$catid];
		$siteid = $GLOBALS['siteid'] = $CAT['siteid'];
		extract($CAT);	
		foreach($TYPE as $_t) $parentids[] = $_t['parentid'];
		$template = ($TYPE[$typeid]['parentid']==0 && in_array($typeid,array_unique($parentids))) ? $WAP_SETTING['category_template'] : $WAP_SETTING['list_template'];	
		$MODEL = getcache('model','commons');
		$modelid = $CAT['modelid'];
		$tablename = $this->db->table_name = $this->db->db_tablepre.$MODEL[$modelid]['tablename'];
		print_r($MODEL = getcache('model','commons'));
		$total = $this->db->count(array('status'=>'99','catid'=>$catid));
		$page = isset($_GET['page']) && intval($_GET['page']) ? intval($_GET['page']) : 1;
		$pagesize = $WAP_SETTING['listnum'] ? intval($WAP_SETTING['listnum']) : 20 ;
		$offset = ($page - 1) * $pagesize;

		$list = $this->db->select('status=99 and catid in (17,18)', '*', $offset.','.$pagesize,'inputtime DESC');
		echo $this->db->lastsql();
		if($json){
			$data=array();
			foreach($list as $k=>$v){
				$data[$k]['id']=$v['id'];
				$data[$k]['title']=$v['title'];
				$data[$k]['status']=$v['id'];
				$data[$k]['created']=$v['inputtime'].'000';
				$data[$k]['url']=$v['url'];
			}
			$data['data']=$data;
			$data['meta']['total']=$total;
			$data['meta']['start']=$page;
			$data['meta']['size']=$pagesize;
		    echo json_encode($data);exit;
		}
		
		//构造wap url规则
		define('URLRULE', 'index.php?m=wap&c=index&a=lists&typeid={$typeid}~index.php?m=wap&c=index&a=lists&typeid={$typeid}&page={$page}');
		$GLOBALS['URL_ARRAY'] = array('typeid'=>$typeid);
		
		$pages = wpa_pages($total, $page, $pagesize);
		include template('wap', $template);
	}

	public function filelist() {

		$typeid =  $_GET['typeid'] ? intval($_GET['typeid']) : 60;

		$catid = $this->types[$typeid]['cat'];
		$siteids = getcache('category_content','commons');
		$siteid = $siteids[$catid];
		$CATEGORYS = getcache('category_content_'.$siteid,'commons');
		if(!isset($CATEGORYS[$catid])) exit(L('parameter_error'));
		$CAT = $CATEGORYS[$catid];
		$MODEL = getcache('model','commons');
		$modelid = $CAT['modelid'];
		$tablename = $this->db->table_name = $this->db->db_tablepre.$MODEL[$modelid]['tablename'];
		$catids=array($catid);
		$list = $this->db->select('status=99 and catid in ('.implode(',',$catids).')', '*','','inputtime DESC');

		foreach($list as $k=>$v){
			$data[$k]['id']=$v['id'];
			$data[$k]['title']=$v['title'];
			$data[$k]['status']=$v['id'];
			$data[$k]['created']=$v['inputtime'].'000';
			$data[$k]['url']=show_url($v['catid'],$v['id']);
		}

		include template('wap', 'filelist');
	}
	
    //展示内容页
	public function show() {
		$typeid = $type_tmp = intval($_GET['typeid']);
		if($typeid==60){
			$_username = param::get_cookie('_username');//当前登录人用户名
			$_userid = param::get_cookie('_userid');//当然登录人id
			if(!$_username){
				Header("Location: /index.php?&a=login");
				exit;
			}
		}

		$wap_jssdk = pc_base::load_app_class("wap_jssdk", "wap");
		$wap_jssdk->__construct("wxfa4e2f447f4bafb6", "97d71b1486606352b7c6d1981952c76b");

		$signPackage = $wap_jssdk->GetSignPackage();

		$_GET['remains']='true';
		$WAP = $this->wap;
		$WAP_SETTING = string2array($WAP['setting']);
		$TYPE = $this->types;
		$GLOBALS['siteid'] = $siteid = max($this->siteid,1);

		$catid = $_GET['catid'];
		$id = intval($_GET['id']);
		if(!$catid || !$id) exit(L('parameter_error'));
		$siteids = getcache('category_content','commons');
		$siteid = $siteids[$catid];
		$CATEGORYS = getcache('category_content_'.$siteid,'commons');
		$page = intval($_GET['page']);
		$page = max($page,1);

		if(!isset($CATEGORYS[$catid]) || $CATEGORYS[$catid]['type']!=0) exit(L('information_does_not_exist','','content'));
		$this->category = $CAT = $CATEGORYS[$catid];
		$this->category_setting = $CAT['setting'] = string2array($this->category['setting']);
		$siteid = $GLOBALS['siteid'] = $CAT['siteid'];
		
		$MODEL = getcache('model','commons');
		$modelid = $CAT['modelid'];
		
		$tablename = $this->db->table_name = $this->db->db_tablepre.$MODEL[$modelid]['tablename'];
		$r = $this->db->get_one(array('id'=>$id));
		if(!$r || $r['status'] != 99) showmessage(L('info_does_not_exists'),'blank');
		
		$this->db->table_name = $tablename.'_data';
		$r2 = $this->db->get_one(array('id'=>$id));
		$rs = $r2 ? array_merge($r,$r2) : $r;

		//再次重新赋值，以数据库为准
		$catid = $CATEGORYS[$r['catid']]['catid'];
		$modelid = $CATEGORYS[$catid]['modelid'];
		
		require_once CACHE_MODEL_PATH.'content_output.class.php';
		$content_output = new content_output($modelid,$catid,$CATEGORYS);
		$data = $content_output->get($rs);
		extract($data);
			
		$typeid = $type_tmp;

	    if(strpos($content, '[/page]')!==false) {
			$content = preg_replace("|\[page\](.*)\[/page\]|U", '', $content);
		} elseif (strpos($content, '[page]')!==false) {
			$content = str_replace('[page]', '', $content);
		}

		//根据设置字节数对文章加入分页标记
		if($maxcharperpage < 10) $maxcharperpage = $WAP_SETTING['c_num'];
		$contentpage = pc_base::load_app_class('contentpage','content');
		$content = $contentpage->get_data($content,$maxcharperpage);
		$isshow = 1;

		
		//进行自动分页处理		
		$CONTENT_POS = strpos($content, '[page]');
		if($CONTENT_POS !== false) {
			$this->url = pc_base::load_app_class('wap_url', 'wap');
			$contents = array_filter(explode('[page]', $content));
			$pagenumber = count($contents);
			if (strpos($content, '[/page]')!==false && ($CONTENT_POS<7)) {
				$pagenumber--;
			}
			for($i=1; $i<=$pagenumber; $i++) {
				$pageurls[$i] = $this->url->show($id, $i, $catid, $typeid);
			}
			$END_POS = strpos($content, '[/page]');
			if($END_POS !== false) {
				if(preg_match_all("|\[page\](.*)\[/page\]|U", $content, $m, PREG_PATTERN_ORDER)) {
					foreach($m[1] as $k=>$v) {
						$p = $k+1;
						$titles[$p]['title'] = strip_tags($v);
						$titles[$p]['url'] = $pageurls[$p][0];
					}
				}
			}
			
			//当不存在 [/page]时，则使用下面分页
			$pages = content_pages($pagenumber,$page, $pageurls);
			//判断[page]出现的位置是否在第一位 
			if($CONTENT_POS<7) {
				$content = $contents[$page];
			} else {
				if ($page==1 && !empty($titles)) {
					$content = $title.'[/page]'.$contents[$page-1];
				} else {
					$content = $contents[$page-1];
				}
			}
			if($_GET['remains']=='true') {
		        $content = $pages ='';
		        for($i=$page;$i<=$pagenumber;$i++) {
		            $content .=$contents[$i-1];
		        }
	    	}			
		}
				
		$content = content_strip(wml_strip($content));
		$desc=strip_tags($content);
		$desc=$this->trimall($desc);
		$desc=mb_substr($desc,0,100);
		$template = $WAP_SETTING['show_template'] ? $WAP_SETTING['show_template'] : 'show';

		if($typeid==60||$typeid==61){
			include template('wap','picture');
		}else{
			include template('wap','detail');
		}


	}
	function trimall($str)//删除空格
	{
		$qian=array(" ","　","\t","\n","\r")
		;$hou=array("","","","","");
		return str_replace($qian,$hou,$str);
	}
	//提交评论
	function comment() {
		$WAP = $this->wap;
		$TYPE = $this->types;		
		if($_POST['dosumbit']) {
			$comment = pc_base::load_app_class('comment','comment');
			pc_base::load_app_func('global','comment');
			$username = $this->wap['sitename'].L('phpcms_friends');
			$userid = param::get_cookie('_userid');		
			$catid = intval($_POST['catid']);		
			$typeid = intval($_POST['typeid']);		
			$contentid = intval($_POST['id']);		
			$msg = trim($_POST['msg']);
			$commentid = remove_xss(safe_replace(trim($_POST['commentid'])));
			$title = $_POST['title'];
			$url = $_POST['url'];	
			
			//通过API接口调用数据的标题、URL地址
			if (!$data = get_comment_api($commentid)) {
				exit(L('parameter_error'));
			} else {
				$title = $data['title'];
				$url = $data['url'];
				unset($data);
			} 		
			$data = array('userid'=>$userid, 'username'=>$username, 'content'=>$msg);
			$comment->add($commentid, $this->siteid, $data, $id, $title, $url);
			echo '<script type="text/javaScript" src="'.JS_PATH.'jquery.min.js"></script><script language="JavaScript" src="'.JS_PATH.'admin_common.js"></script>';
			echo L('wap_guestbook').'<br/><a href="'.show_url($catid,$contentid,$typeid).'">'.L('wap_goback').'</a><script language=javascript>setTimeout("redirect(\''.HTTP_REFERER.'\');",3000);</script>';
		}
	}
	
	//评论列表页
	function comment_list() {
		$WAP = $this->wap;
		$TYPE = $this->types;		
		$comment = pc_base::load_app_class('comment','comment');
		pc_base::load_app_func('global','comment');	
		$typeid  = intval($_GET['typeid']);	
		$GLOBALS['siteid'] = max($this->siteid,1);
		$commentid = isset($_GET['commentid']) && trim(addslashes(urldecode($_GET['commentid']))) ? trim(addslashes(urldecode($_GET['commentid']))) : exit(L('illegal_parameters'));
		if(!preg_match("/^[a-z0-9_\-]+$/i",$commentid)) exit(L('illegal_parameters'));
		list($modules, $contentid, $siteid) = decode_commentid($commentid);	
		list($module, $catid) = explode('_', $modules);
		$comment_setting_db = pc_base::load_model('comment_setting_model');
		$setting = $comment_setting_db->get_one(array('siteid'=>$this->siteid));	
		
		//通过API接口调用数据的标题、URL地址
		if (!$data = get_comment_api($commentid)) {
			exit(L('illegal_parameters'));
		} else {
			$title = $data['title'];
			$url = $data['url'];
			unset($data);
		}
					
		include template('wap', 'comment_list');
	}
	
	//导航页
	function maps() {
		$WAP = $this->wap;
		$TYPE = $this->types;
		$WAP_SETTING = string2array($WAP['setting']);	
		$GLOBALS['siteid'] = max($this->siteid,1);	
		include template('wap', 'maps');
	}
	
	//展示大图
	function big_image() {
		$WAP = $this->wap;
		$TYPE = $this->types;
		$WAP_SETTING = string2array($WAP['setting']);
		$GLOBALS['siteid'] = max($this->siteid,1);		
		$url=base64_decode(trim($_GET['url']));
		$url = str_replace(array('"',"'",'(',')',' '),'',$url);
		if(!preg_match('/(jpg|png|gif|bmp)$/i',fileext($url))) exit('img src error');
		$width = $_GET['w'] ?  trim(intval($_GET['w'])) : 320 ;
		$new_url = thumb($url,$width,0);
		include template('wap', 'big_image');
	}

	public function login() {

		include template('wap', 'login');
	}

	public function ajaxlogin() {
		$username = isset($_POST['username']) && is_username($_POST['username']) ? trim($_POST['username']) : showmessage(L('username_empty'), HTTP_REFERER);
		$password = isset($_POST['password']) && trim($_POST['password']) ? trim($_POST['password']) : showmessage(L('password_empty'), HTTP_REFERER);
		$synloginstr = ''; //同步登陆js代码
		$this->member_db = pc_base::load_model('member_model');
		//查询帐号
		$r = $this->member_db->get_one(array('username'=>$username));


		if(!$r) showmessage(L('user_not_exist'),'index.php?m=member&c=index&a=login');
		//密码错误剩余重试次数
		$this->times_db = pc_base::load_model('times_model');
		$rtime = $this->times_db->get_one(array('username'=>$username));


		//查询帐号
		$r = $this->member_db->get_one(array('username'=>$username));

		if(!$r) showmessage(L('user_not_exist'),'index.php?m=member&c=index&a=login');

		//验证用户密码
		$password = md5(md5(trim($password)).$r['encrypt']);
		if($r['password'] != $password) {
			$ip = ip();
			if($rtime && $rtime['times'] < 5) {
				$times = 5 - intval($rtime['times']);
				$this->times_db->update(array('ip'=>$ip, 'times'=>'+=1'), array('username'=>$username));
			} else {
				$this->times_db->insert(array('username'=>$username, 'ip'=>$ip, 'logintime'=>SYS_TIME, 'times'=>1));
				$times = 5;
			}
			showmessage(L('password_error', array('times'=>$times)), 'index.php?m=member&c=index&a=login', 3000);
		}
		$this->times_db->delete(array('username'=>$username));

		//如果用户被锁定
		if($r['islock']) {
			showmessage(L('user_is_lock'));
		}

		$userid = $r['userid'];
		$groupid = $r['groupid'];
		$username = $r['username'];
		$nickname = empty($r['nickname']) ? $username : $r['nickname'];

		$updatearr = array('lastip'=>ip(), 'lastdate'=>SYS_TIME);
		//vip过期，更新vip和会员组
		if($r['overduedate'] < SYS_TIME) {
			$updatearr['vip'] = 0;
		}

		//检查用户积分，更新新用户组，除去邮箱认证、禁止访问、游客组用户、vip用户，如果该用户组不允许自助升级则不进行该操作
		if($r['point'] >= 0 && !in_array($r['groupid'], array('1', '7', '8')) && empty($r[vip])) {
			$grouplist = getcache('grouplist');
			if(!empty($grouplist[$r['groupid']]['allowupgrade'])) {
				$check_groupid = $this->_get_usergroup_bypoint($r['point']);

				if($check_groupid != $r['groupid']) {
					$updatearr['groupid'] = $groupid = $check_groupid;
				}
			}
		}

		//如果是connect用户
		if(!empty($_SESSION['connectid'])) {
			$updatearr['connectid'] = $_SESSION['connectid'];
		}
		if(!empty($_SESSION['from'])) {
			$updatearr['from'] = $_SESSION['from'];
		}
		unset($_SESSION['connectid'], $_SESSION['from']);

		$this->member_db->update($updatearr, array('userid'=>$userid));

		if(!isset($cookietime)) {
			$get_cookietime = param::get_cookie('cookietime');
		}


		$_cookietime = $cookietime ? intval($cookietime) : ($get_cookietime ? $get_cookietime : 0);
		$cookietime = $_cookietime ? SYS_TIME + $_cookietime : 0;
		$cookietime = time()+3600*24*30;

		$phpcms_auth = sys_auth($userid."\t".$password, 'ENCODE', 'qwertyuiop');
		param::set_cookie('auth', $phpcms_auth, $cookietime);
		param::set_cookie('_userid', $userid, $cookietime);
		param::set_cookie('_username', $username, $cookietime);
		param::set_cookie('_groupid', $groupid, $cookietime);
		param::set_cookie('_nickname', $nickname, $cookietime);

		showmessage('登录成功','','','',0,0);

	}

	public function reg() {

		include template('wap', 'reg');
	}
	private function _session_start() {
		$session_storage = 'session_'.pc_base::load_config('system','session_storage');
		pc_base::load_sys_class($session_storage);
	}
	public function account() {
		$_username = param::get_cookie('_username');//当前登录人用户名
		$_userid = param::get_cookie('_userid');//当然登录人id
		if(!$_username){
			Header("Location: /index.php?&a=login");
			exit;
		}

		include template('wap', 'account');
	}

	public function logout() {
		    $setting = pc_base::load_config('system');
			param::set_cookie('auth', '');
			param::set_cookie('_userid', '');
			param::set_cookie('_username', '');
			param::set_cookie('_groupid', '');
			param::set_cookie('_nickname', '');
			param::set_cookie('cookietime', '');
			Header("Location: /index.php?&a=login");
			exit;
	}

	/**
	 * 我的收藏
	 *
	 */
	public function favorite() {
		$this->favorite_db = pc_base::load_model('favorite_model');
		$_userid = param::get_cookie('_userid');//当然登录人id
		$this->member_db = pc_base::load_model('member_model');
		$this->memberinfo = $this->member_db->get_one(array('userid'=>$_userid));
		$memberinfo = $this->memberinfo;
		if(isset($_GET['id']) && trim($_GET['id'])) {
			$this->favorite_db->delete(array('userid'=>$memberinfo['userid'], 'id'=>intval($_GET['id'])));
			showmessage(L('operation_success'), HTTP_REFERER);
		} else {
			$page = isset($_GET['page']) && trim($_GET['page']) ? intval($_GET['page']) : 1;
			$favoritelist = $this->favorite_db->listinfo(array('userid'=>$memberinfo['userid']), 'id DESC', $page, 100);
			//include template('member', 'favorite_list');
		}

		include template('wap', 'favorite');
	}

	public function time() {
		$data['time']=time().'000';
		echo json_encode($data);
	}
	public function analysis() {

		$_userid = param::get_cookie('_userid');//当然登录人id
		$this->member_db = pc_base::load_model('member_model');
		$this->memberinfo = $this->member_db->get_one(array('userid'=>$_userid));
		$memberinfo = $this->memberinfo;
		$industry=self::industry;
		$credit=self::credit;

		$userid=param::get_cookie('_userid');
		$company_db = pc_base::load_model('company_model');
		$one = $company_db->get_one(array('userid'=>$userid));
		if($one){
			$company_financial_db = pc_base::load_model('company_financial_model');
			$financial=$company_financial_db->select(array('company_id'=>$one['id']));
		}

		include template('wap', 'analysis');
	}

	public function addanalysis() {
		$json= file_get_contents("php://input");
		$jsonArr=json_decode($json,true);
		$userid=param::get_cookie('_userid');

		$data=array(
			'userid'=>$userid,//当然登录人id,
			'enterprise_name'=>$jsonArr['company'],
			'industry'=>$jsonArr['industry'],
			'contact_name'=>$jsonArr['username'],
			'contact_telephone'=>$jsonArr['phone'],
			'contact_email'=>$jsonArr['email'],
			'website'=>$jsonArr['url'],
			'workers_total'=>$jsonArr['totalNum'],
			'credit_rating'=>$jsonArr['grade'],
			'research_num'=>$jsonArr['yfNum'],
			'college_above_num'=>$jsonArr['dzNum'],
			'enterprise_natur'=>$jsonArr['qyxz'],
			'qualifications_other'=>$jsonArr['otherQyzz'],
			'enterprise_qualifications'=>$jsonArr['qyzz'],
			'features_other'=>$jsonArr['otherQytx'],
			'features_info'=>$jsonArr['markQytx'],
			'enterprise_features'=>$jsonArr['qytx'],
			'business_other'=>$jsonArr['otherSyms'],
			'business_model'=>$jsonArr['syms'],
			'IP_invention_patent'=>$jsonArr['patNum'],
			'IP_trademark'=>$jsonArr['brandNum'],
			'IP_software_copyright'=>$jsonArr['workNum'],
			'create_time'=>time(),
		);
		$company_db = pc_base::load_model('company_model');
		$one = $company_db->get_one(array('userid'=>$userid));
		if($one){
			$company_db->update($data,$one['id']);
			$companyid=$one['id'];
		}else{
			$companyid=$company_db->insert($data,true);
		}

		if($companyid>0){
			$company_financial_db = pc_base::load_model('company_financial_model');
			$company_financial_db->delete(array('company_id'=>$companyid));
			$finance=json_decode($jsonArr['finance'],true);
			foreach($finance as $k=>$v){
				$data_finance=array(
					'company_id'=>$companyid,
					'year'=>$k,
					'general_assets'=>$v['sum'],
					'sales_revenue'=>$v['income'],
					'total_profits'=>$v['profit'],
					'create_time'=>time(),
				);
				$company_financial_db->insert($data_finance);
			}
		}
		$_SERVER['HTTP_X_AJAX']=true;
		showmessage('提交成功','','','',0,0);

	}

}
?>