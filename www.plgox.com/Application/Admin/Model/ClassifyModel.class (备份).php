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
			$list_tr.='<tr class="table_tr_'.$v['classify_id'].'">';
			$list_tr.='<td style="text-align: center;line-height:50px;"><input type="checkbox" name="" value="'.$v['classify_id'].'" class="check"></td>';
			$list_tr.='<td style="text-align: center;line-height:50px;">'.$v['classify_id'].'</td>';
			if( $this->where( array("classify_pid"=>$v['classify_id']))->count() != '0'  ){
				$list_tr.="<td style='line-height:50px;'><span style='cursor:pointer' class='glyphicon glyphicon-plus' onclick=\"showHide('sun".$v['classify_id']."')\"></span>&nbsp;&nbsp;".$v['classify_title']."<b style='color:red'>【顶级分类】</b></td>";
			}else{
				$list_tr.='<td style="line-height:50px;">'.$v['classify_title'].'<b style="color:red">【顶级分类】</b></td>';
			}
			$list_tr.='<td style="text-align: center;line-height:50px;">'.date('Y-m-d H:i:s',$v['classify_createtime']).'</td>';
			$list_tr.='<td style="text-align: center;line-height:50px;"><input type="text" value="'.$v['classify_order'].'" style="width:40px;height:30px;line-height:10px;text-align: center" readonly="readonly"></td>';
			if( $v['classify_status'] ==  '0' ){
				$list_tr.='<td style="text-align: center;line-height:50px;"><span class="glyphicon glyphicon-ok-sign"></span></td>';
			}else{
				$list_tr.='<td style="text-align: center;line-height:50px;"><span class="glyphicon glyphicon-remove-sign"></span></td>';
			}
			$list_tr.="<td style='text-align: center;line-height:50px;'>
							<a href='share_level_classify&share_level_classify_id=".base64_encode($v['classify_id'])."' title='添加子分类'>添加子分类</a>&nbsp;&nbsp;
							<a href='share_classify_data&classify_update_id=".base64_encode($v['classify_id'])."' title='编辑板块' class=''>编辑</a>&nbsp;&nbsp;
							<a href='javascript:void(0);' title='删除' class='del' value='".$v['classify_id']."'>删除</a>&nbsp;&nbsp;
					  </td>";
			$list_tr.='</tr>';
			// $list_tr.="<tbody id='sun".$v['classify_id']."' style='display:none'>";
    		$list_tr.=$this->get_classify($v['classify_id'],"|---");
			// $list_tr.="</tbody>";
		}
		return $list_tr;
	}
	// 子id
	public function get_classify($cid,$step){
				$classify_ = $this->where( array("classify_pid"=>array("EQ",$cid)) )->select();
				$list_trs = "";
				foreach( $classify_ as $key => $value ){
					$list_trs.='<tr class="table_tr_'.$value['classify_id'].'">';
					$list_trs.='<td style="text-align: center;line-height:50px;"><input type="checkbox" name="" value="'.$value['classify_id'].'" class="check"></td>';
					$list_trs.='<td style="text-align: center;line-height:50px;">'.$value['classify_id'].'</td>';
					if( $this->where( array("classify_pid"=>$value['classify_id']))->count() != '0'  ){
					$list_trs.='<td style="line-height:50px;"><span style="cursor:pointer" class="glyphicon glyphicon-plus" onclick=\'showHide("sun'.$value['classify_id'].'")\'></span>&nbsp;&nbsp;'.$step.$value['classify_title'].'</td>';
					}else{
						$list_trs.='<td style="line-height:50px;">'.$step.$value['classify_title'].'</td>';
					}
					$list_trs.='<td style="text-align: center;line-height:50px;">'.date('Y-m-d H:i:s',$value['classify_createtime']).'</td>';
					$list_trs.='<td style="text-align: center;line-height:50px;"><input type="text" value="'.$value['classify_order'].'" style="height:30px;width:40px;line-height:10px;text-align: center" readonly="readonly"></td>';
					if( $value['classify_status'] ==  '0' ){
						$list_trs.='<td style="text-align: center;line-height:50px;"><span class="glyphicon glyphicon-ok-sign"></span></td>';
					}else{
						$list_trs.='<td style="text-align: center;line-height:50px;"><span class="glyphicon glyphicon-remove-sign"></span></td>';
					}
					$list_trs.="<td style='text-align: center;line-height:50px;'>
									<a href='share_level_classify&share_level_classify_id=".base64_encode($value['classify_id'])."' title='添加子分类'>添加子分类</a>&nbsp;&nbsp;
									<a href='share_classify_data&classify_update_id=".base64_encode($value['classify_id'])."' title='编辑板块' class=''>编辑</a>&nbsp;&nbsp;
									<a href='javascript:void(0);' title='删除' class='del' value='".$value['classify_id']."'>删除</a>&nbsp;&nbsp;
							  </td>";
					$list_trs.='</tr>';
					// $list_trs.="<tbody id='sun".$value['classify_id']."' style='display:none'>";
					$list_trs.=$this->get_classify($value['classify_id'],$step."|---");
					// $list_trs.="</tbody>";
				}
			return $list_trs;
		}
}
?>