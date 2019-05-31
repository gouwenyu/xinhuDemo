<?php 
namespace Admin\Model;
use Think\Model;
class ClassifyModel extends Model {
//分类展示 
public function classify_lists($cid) {
	$classify_sel = D('Classify')->field("classify_id,classify_title,classify_path,concat(classify_path,'-',classify_id) as abspath")->order("abspath asc")->select();
	$option = "";
	foreach( $classify_sel as $key => $val ){
		$val['level'] = substr_count($val['abspath'],"-");
		$val['subfix'] = str_repeat("---",$val['level']*1);
		if( $val['classify_id'] == $cid ){
			$option.="<option value=".$val['classify_id']." selected='selected'>".$val['subfix'].$val['classify_title']."</option>";
		}else{
			$option.="<option value=".$val['classify_id'].">".$val['subfix'].$val['classify_title']."</option>";
		}
	}
	return $option;
}

public function classify_list() {
		// 父id
		$classify = $this->where(array("classify_pid"=>array("EQ",0)))->select();
		$list_tr = "";
		foreach( $classify as $k => $v ){
			$list_tr.='<ul class="table-row table_tr_'.$v['classify_id'].'">';   
			$list_tr.='<li class="table-cell_" style="border-bottom: 1px solid #CCC;">';
			$list_tr.='<input type="checkbox" name="" value="'.$v['classify_id'].'" class="check" style="position:relative;left:20px;">';
			$list_tr.='<span style="position:relative;left:25px;">'.$v['classify_id'].'</span>';
			if( $this->where( array("classify_pid"=>$v['classify_id']))->count() != '0'  ){
				$list_tr.="<span style='cursor:pointer;position:relative;left:60px;' class='glyphicon glyphicon-plus' onclick=\"showHide('sun".$v['classify_id']."')\"></span>&nbsp;&nbsp;<span style='position:relative;left:60px;' >".$v['classify_title']."</span><b style='color:red;position:relative;left:60px;'>【顶级分类】</b>";
			}else{
				$list_tr.='<span style="pointer;position:relative;left:80px;" >'.$v['classify_title'].'<b style="color:red;<span style="pointer;">【顶级分类】</b></span>';
			}
			// <span style="pointer;position:relative;left:60px;"></span>
			$list_tr.='<span style="pointer;position:relative;left:80px;">'.date('Y-m-d H:i:s',$v['classify_createtime']).'</span>';
			$list_tr.='<span style="pointer;position:relative;left:100px;"><input type="text" value="'.$v['classify_order'].'" style="width:40px;height:30px;line-height:10px;text-align: center" readonly="readonly"></span>';
			if( $v['classify_status'] ==  '0' ){
				$list_tr.='<span style="pointer;position:relative;left:120px;" class="glyphicon glyphicon-ok-sign"></span>';
			}else{
				$list_tr.='<span style="pointer;position:relative;left:120px;" class="glyphicon glyphicon-remove-sign"></span>';
			}
			$list_tr.="<span style='pointer;position:relative;left:130px;'>
							<a href='share_level_classify&share_level_classify_id=".base64_encode($v['classify_id'])."' title='添加子分类'>添加子分类</a>&nbsp;&nbsp;
							<a href='share_classify_data&classify_update_id=".base64_encode($v['classify_id'])."' title='编辑板块' class=''>编辑</a>&nbsp;&nbsp;
							<a href='javascript:void(0);' title='删除' class='del' value='".$v['classify_id']."'>删除</a>&nbsp;&nbsp;
					   </span>";
			$list_tr.='</li>';
			$list_tr.="<ul id='sun".$v['classify_id']."' style='display:none'>";
			$list_tr.=$this->get_classify($v['classify_id'],"&nbsp;&nbsp;&nbsp;&nbsp;");
			$list_tr.="</ul>";
			/*$list_tr.='<li class="table-cell_" style="border-bottom: 1px solid #CCC;"><input type="checkbox" name="" value="'.$v['classify_id'].'" class="check" style="position:relative;left:20px;"></li>';
			$list_tr.='<li class="table-cell_" style="border-bottom: 1px solid #CCC;"><span>'.$v['classify_id'].'</span></li>';
			if( $this->where( array("classify_pid"=>$v['classify_id']))->count() != '0'  ){
				$list_tr.= "<li class='table-cell_' style='border-bottom: 1px solid #CCC;'><span style='cursor:pointer;' class='glyphicon glyphicon-plus' onclick=\"showHide('sun".$v['classify_id']."')\"></span>&nbsp;&nbsp;<span>".$v['classify_title']."</span><b style='color:red;'>【顶级分类】</b></li>";
			}else{
				$list_tr.= '<li class="table-cell_" style="border-bottom: 1px solid #CCC;"><span style="pointer;" >'.$v['classify_title'].'<b style="color:red;<span style="pointer;">【顶级分类】</b></span></li>';
			}
			$list_tr.= '<li class="table-cell_" style="border-bottom: 1px solid #CCC;"><span>'.date('Y-m-d H:i:s',$v['classify_createtime']).'</span></li>';
			$list_tr.= '<li class="table-cell_" style="border-bottom: 1px solid #CCC;"><span style="pointer;"><input type="text" value="'.$v['classify_order'].'" style="width:40px;height:30px;line-height:10px;text-align: center" readonly="readonly"></span></li>';
			if( $v['classify_status'] ==  '0' ){
				$list_tr.= '<li class="table-cell_" style="border-bottom: 1px solid #CCC;"><span style="pointer;" class="glyphicon glyphicon-ok-sign"></span></li>';
			}else{
				$list_tr.= '<li class="table-cell_" style="border-bottom: 1px solid #CCC;"><span style="pointer;" class="glyphicon glyphicon-remove-sign"></span></li>';
			}
			$list_tr.= "<li class='table-cell_' style='border-bottom: 1px solid #CCC;'>
							<span style='pointer;'>
							<a href='share_level_classify&share_level_classify_id=".base64_encode($v['classify_id'])."' title='添加子分类'>添加子分类</a>&nbsp;&nbsp;
							<a href='share_classify_data&classify_update_id=".base64_encode($v['classify_id'])."' title='编辑板块' class=''>编辑</a>&nbsp;&nbsp;
							<a href='javascript:void(0);' title='删除' class='del' value='".$v['classify_id']."'>删除</a>&nbsp;&nbsp;
					   </span>
						</li>";
			$list_tr.="<sapn id='sun".$v['classify_id']."' style='display:none'>";
			$list_tr.=$this->get_classify($v['classify_id'],"&nbsp;&nbsp;&nbsp;&nbsp;");
			$list_tr.="</sapn>";*/
			$list_tr.='</ul>';
		}
		return $list_tr;
	}
	// 子id
	public function get_classify($cid,$step){
				$classify_ = $this->where( array("classify_pid"=>array("EQ",$cid)) )->select();
				$list_trs = "";
				foreach( $classify_ as $key => $value ){
					$list_trs.='<ul class="table-row table_tr_'.$value['classify_id'].'">';   
					$list_trs.='<li class="table-cell_" style="border-bottom: 1px solid #CCC;">';
					$list_trs.='<input type="checkbox" name="" value="'.$value['classify_id'].'" class="check" style="position:relative;left:20px;">';
					$list_trs.='<span style="position:relative;left:25px;">'.$value['classify_id'].'</span>';
					if( $this->where( array("classify_pid"=>$value['classify_id']))->count() != '0'  ){
						$list_trs.="<span style='cursor:pointer;position:relative;left:60px;' class='glyphicon glyphicon-plus' onclick=\"showHide('sun".$value['classify_id']."')\"></span>&nbsp;&nbsp;<span style='position:relative;left:60px;' >".$step.$value['classify_title']."</span>";
					}else{
						$list_trs.='<span style="pointer;position:relative;left:80px;" >'.$step.$value['classify_title'].'</span>';
					}
					// <span style="pointer;position:relative;left:60px;"></span>
					$list_trs.='<span style="pointer;position:relative;left:100px;">'.date('Y-m-d H:i:s',$value['classify_createtime']).'</span>';
					$list_trs.='<span style="pointer;position:relative;left:130px;"><input type="text" value="'.$value['classify_order'].'" style="width:40px;height:30px;line-height:10px;text-align: center" readonly="readonly"></span>';
					if( $value['classify_status'] ==  '0' ){
						$list_trs.='<span style="pointer;position:relative;left:160px;" class="glyphicon glyphicon-ok-sign"></span>';
					}else{
						$list_trs.='<span style="pointer;position:relative;left:160px;" class="glyphicon glyphicon-remove-sign"></span>';
					}
					$list_trs.="<span style='pointer;position:relative;left:180px;'>
									<a href='share_level_classify&share_level_classify_id=".base64_encode($value['classify_id'])."' title='添加子分类'>添加子分类</a>&nbsp;&nbsp;
									<a href='share_classify_data&classify_update_id=".base64_encode($value['classify_id'])."' title='编辑板块' class=''>编辑</a>&nbsp;&nbsp;
									<a href='javascript:void(0);' title='删除' class='del' value='".$value['classify_id']."'>删除</a>&nbsp;&nbsp;
							   </span>";
					$list_trs.='</li>';
					$list_trs.="<ul id='sun".$value['classify_id']."' style='display:none'>";
					$list_trs.=$this->get_classify($value['classify_id'],$step."&nbsp;&nbsp;&nbsp;&nbsp;");
					$list_trs.="</ul>";

					// $list_tr.= '<li class="table-cell_" style="border-bottom: 1px solid #CCC;"></li>';

					/*$list_trs.='<li class="table-cell_" style="border-bottom: 1px solid #CCC;"><input type="checkbox" name="" value="'.$value['classify_id'].'" class="check" style="position:relative;left:20px;"></li>';
					$list_trs.='<li class="table-cell_" style="border-bottom: 1px solid #CCC;"><span>'.$value['classify_id'].'</span></li>';
					if( $this->where( array("classify_pid"=>$v['classify_id']))->count() != '0'  ){
						$list_trs.= "<li class='table-cell_' style='border-bottom: 1px solid #CCC;'><span style='cursor:pointer;' class='glyphicon glyphicon-plus' onclick=\"showHide('sun".$v['classify_id']."')\"></span>&nbsp;&nbsp;<span>".$v['classify_title']."</span><b style='color:red;'>【顶级分类】</b></li>";
					}else{
						$list_trs.= '<li class="table-cell_" style="border-bottom: 1px solid #CCC;"><span style="pointer;" >'.$v['classify_title'].'<b style="color:red;<span style="pointer;">【顶级分类】</b></span></li>';
					}
					$list_trs.= '<li class="table-cell_" style="border-bottom: 1px solid #CCC;"><span>'.date('Y-m-d H:i:s',$v['classify_createtime']).'</span></li>';
					$list_trs.= '<li class="table-cell_" style="border-bottom: 1px solid #CCC;"><span style="pointer;"><input type="text" value="'.$v['classify_order'].'" style="width:40px;height:30px;line-height:10px;text-align: center" readonly="readonly"></span></li>';
					if( $v['classify_status'] ==  '0' ){
						$list_trs.= '<li class="table-cell_" style="border-bottom: 1px solid #CCC;"><span style="pointer;" class="glyphicon glyphicon-ok-sign"></span></li>';
					}else{
						$list_trs.= '<li class="table-cell_" style="border-bottom: 1px solid #CCC;"><span style="pointer;" class="glyphicon glyphicon-remove-sign"></span></li>';
					}
					$list_trs.= "<li class='table-cell_' style='border-bottom: 1px solid #CCC;'>
									<span style='pointer;'>
									<a href='share_level_classify&share_level_classify_id=".base64_encode($v['classify_id'])."' title='添加子分类'>添加子分类</a>&nbsp;&nbsp;
									<a href='share_classify_data&classify_update_id=".base64_encode($v['classify_id'])."' title='编辑板块' class=''>编辑</a>&nbsp;&nbsp;
									<a href='javascript:void(0);' title='删除' class='del' value='".$v['classify_id']."'>删除</a>&nbsp;&nbsp;
							   </span>
								</li>";
					$list_trs.="<span id='sun".$value['classify_id']."' style='display:none'>";
					$list_trs.=$this->get_classify($value['classify_id'],$step."&nbsp;&nbsp;&nbsp;&nbsp;");
					$list_trs.="</span>";*/
					$list_trs.='</ul>';
				}
			return $list_trs;
		}
}
?>