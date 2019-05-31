window.alert = function(str) 
{ 
var shield = document.createElement("DIV"); 
shield.id = "shield"; 
shield.style.position = "absolute"; 
shield.style.left = "0px"; 
shield.style.top = "0px"; 
shield.style.width = "100%"; 
shield.style.height = document.body.scrollHeight+"px"; 
//弹出对话框时的背景颜色 
shield.style.background = "black"; 
shield.style.opacity = "0.2"; 

shield.style.textAlign = "center"; 
shield.style.zIndex = "999999991"; 
//背景透明 IE有效 
//shield.style.filter = "alpha(opacity=0)"; 
var alertFram = document.createElement("DIV"); 
alertFram.id="alertFram"; 
alertFram.style.position = "fixed"; 
alertFram.style.left = "0px"; 
alertFram.style.top = "0px"; 
alertFram.style.right = "0px"; 
alertFram.style.bottom = "0px"; 
alertFram.style.margin = "auto";
alertFram.style.width = "450px"; 
alertFram.style.height = "150px"; 
alertFram.style.background = "white"; 
alertFram.style.textAlign = "center"; 
alertFram.style.lineHeight = "150px"; 
alertFram.style.borderRadius = "10px";
alertFram.style.zIndex = "999999992"; 
strHtml = "<ul style=\"list-style:none;margin:0px;padding:0px;width:100%\">\n"; 
strHtml += " <li style=\"text-align:left;border-bottom:1px solid #CCCCCC;padding-left:20px;font-size:14px;font-weight:bold;height:35px;line-height:35px;\">[自定义提示]</li>\n"; 
strHtml += " <li style=\"text-align:center;font-size:14px;height:70px;line-height:70px;\">"+str+"</li>\n"; 
strHtml += " <li style=\"position: absolute;height: 35px;width: 100%;text-align: right;right: 0px;padding-right: 26px;color: #558BDD;line-height: 40px; font-size: 14px;bottom: 0px;cursor: pointer;\"><span  onclick=\"doOk()\">关闭</span></li>\n"; 
strHtml += "</ul>\n"; 
alertFram.innerHTML = strHtml; 
document.body.appendChild(alertFram); 
document.body.appendChild(shield); 
//var ad = setInterval("doAlpha()",5); 
this.doOk = function(){ 
alertFram.style.display = "none"; 
shield.style.display = "none"; 
} 
alertFram.focus(); 
document.body.onselectstart = function(){return false;}; 
} 

