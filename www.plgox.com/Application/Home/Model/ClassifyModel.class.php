<?php
namespace Home\Model;
use Think\Model;
class ClassifyModel extends Model{
	// 分类 方便调用
	public function classify_index($cid){
		$classify = D("Classify")->field("classify_id,classify_title,classify_path,concat(classify_path,'-',classify_id) as abspath")->order("abspath asc")->select();
		$option = "";
		foreach( $classify as $key=>$val ){
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
	// 商品列表商品信息
	public function shop_info( $share_value ){
		$list_ = "";
		foreach($share_value as $key => $value) {
			$specifications = D("specifications")->where(array("specifications_id"=>array("in",$value['share_product_type_id'])))->select();//租金查询
			$list_.='<li class="zulin81" >';
			$list_.='<a href="'.getDomain().'/Cart/shop_detil/id/'.$value['share_id'].'">';
			$list_.='<div  class="zulin82">';
			$list_.='<img src="/Uploads/admin/'.$value['share_home_img'].'" />';
			$list_.='</div>';
			$list_.='<div  class="zulin83">';
			$list_.='<div class="zulin831">'.$value['share_name'].'</div>';
			$list_.='</div>';
			$list_.='<div  class="zulin85">';
			$list_.='<span class="zulin851">';
			$list_.='¥'.$specifications['0']['specifications_rent'].'/天';
			$list_.='</span>';
			$list_.='</div>';
			$list_.='<div class="in_center1228">';
			$list_.='<div class="in_center12281">';
			$list_.='<span class="incenter_12_hs">满意度：</span>';
			$list_.='<span class="incenter_12_zs">'.$specifications['0']['specifications_satisfaction'].'%</span>';
			$list_.='</div>';
			$list_.='<div class="in_center12282">';
			$list_.='<span class="incenter_12_hs">出租率：</span>';
			$list_.='<span class="incenter_12_zs">'.$specifications['0']['specifications_chuzu'].'次</span>';
			$list_.='</div>';
			$list_.='</div>';
			$list_.='</a>';
			$list_.='<li>';
        }
        return $list_;
	}
}
?>