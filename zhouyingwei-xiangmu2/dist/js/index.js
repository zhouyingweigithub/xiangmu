"use strict";$(function(){$("#quanbu").hover(function(){$("#fenlei").css("display","block")},function(){$("#fenlei").css("display","block")}),$("#fenlei").hover(function(){$("#fenlei").css("display","block")},function(){$("#fenlei").css("display","block")});var i=0,t=0,n=0,e=4e3,a=1e3,l=setInterval(s,e),o=$("#liimg li").outerWidth();function s(){$("#liimg li").eq(i).animate({right:o},a),i=++i>$("#liimg li").length-1?0:i,$("#liimg li").eq(i).css("right",-o),$("#liimg li").eq(i).animate({right:0},a),c(i),t=i}function c(i){$("#xiaotupiao div").attr("class",""),$("#xiaotupiao div").eq(i).addClass("gaoliang")}$("#liimg li").css("right",-o),$("#liimg li").eq(0).css("right",0),$("#left").click(function(){new Date-n>e&&($("#liimg li").eq(i).animate({right:-o},a),i=--i<0?$("#liimg li").length-1:i,$("#liimg li").eq(i).css("right",o),$("#liimg li").eq(i).animate({right:0},a),c(i),t=i,n=new Date)}),$("#right").click(function(){new Date-n>e&&(s(),n=new Date)}),$("#xiaotupiao div").click(function(){console.log(1),new Date-n>a&&(t=$(this).html()-1,i<t&&($("#liimg li").eq(i).animate({right:o},a),i=++i>$("#liimg li").length-1?0:i,i=t,$("#liimg li").eq(i).css("right",-o),$("#liimg li").eq(i).animate({right:0},a),c(i)),t<i&&($("#liimg li").eq(i).animate({right:-o},a),i=--i<0?$("#liimg li").length-1:i,i=t,$("#liimg li").eq(i).css("right",o),$("#liimg li").eq(i).animate({right:0},a),c(i)),n=new Date)}),$("#box").hover(function(){clearInterval(l)},function(){l=setInterval(s,e)});var h=$(".list-1").eq(0).offset().top-$(window).outerHeight()+200,g=$(".list-1").eq(1).offset().top-$(window).outerHeight()+200,r=$(".list-1").eq(2).offset().top-$(window).outerHeight()+200,m=$(".list-1").eq(3).offset().top-$(window).outerHeight()+200,u=$(".list-1").eq(4).offset().top-$(window).outerHeight()+200,p=$(".list-1").eq(5).offset().top-$(window).outerHeight()+200,f=!0,d=1;function v(i,n){$.ajax({type:"POST",url:"api/api.php",data:"jiekou=xuanran&biao=list&leixing=fenlei1&mingcheng="+i+"&tiao=0&tiao2=4",success:function(i){var t=JSON.parse(i).map(function(i){return'<li data-id="'+i.id+'">\n                          <div class="img"><img src="img/list-img/'+i.img+'" alt=""></div>\n                          <div class="jiesao">\n                              <p class="name">'+i.name+'</p>\n                              <p class="price">\n                                  <span class="price-prev">¥'+i.jiage1+'.00</span>\n                                  <span class="price-next">¥'+i.jiage2+".00</span>\n                              </p>\n                          </div>\n                      </li>"}).join(" ");f=!0,1==n&&($(".shangpin").eq(0).get(0).innerHTML+=t),2==n&&($(".shangpin").eq(1).get(0).innerHTML+=t),3==n&&($(".shangpin").eq(2).get(0).innerHTML+=t),4==n&&($(".shangpin").eq(3).get(0).innerHTML+=t),5==n&&($(".shangpin").eq(4).get(0).innerHTML+=t),6==n&&($(".shangpin").eq(5).get(0).innerHTML+=t)}})}$(window).scroll(function(){var i=$(window).scrollTop();h<=i&&1==d&&f&&(f=!1,v("绿茶",d),d++),g<=i&&2==d&&f&&(f=!1,v("红茶",d),d++),r<=i&&3==d&&f&&(f=!1,v("乌龙茶",d),d++),m<=i&&4==d&&f&&(f=!1,v("黑茶",d),d++),u<=i&&5==d&&f&&(f=!1,v("绿茶",d),d++),p<=i&&6==d&&f&&(f=!1,v("花果茶",d),d++)}),$("#fenlei li a").click(function(){var i=$(this).html();location.href="html/list.html?"+i}),$("#fenlei2 div ul li span a").click(function(){var i=$(this).parent().parent().parent().parent().index(),t=$("#fenlei li a").eq(i).html(),n=$(this).parent().prev().html(),e=$(this).html();location.href="html/list.html?"+t+"-"+n+"-"+e}),$("#sousuo").click(function(){var i=$("#neirong").val();location.href="html/list.html?"+i}),$(".shangpin").on("click","li",function(){var i=$(this).get(0).dataset.id;location.href="html/detail.html?"+i});var q=document.cookie.split("="),w=q[1];2<=q.length&&($.ajax({type:"POST",url:"api/api.php",data:"jiekou=xuanran&biao=user&leixing=id&mingcheng="+w+"&tiao=0&tiao2=1",success:function(i){var t='<div class="denglu">\n                    <a href="javascript:;" id="name">'+JSON.parse(i)[0].name+'</a>\n                    <a>欢迎登录和茶网！</a>\n                    <a href="javascript:;" id="tuichu">[退出登录]</a>\n                </div>';$(".hl").html(t),$("#tuichu").click(function(){var i=new Date;i.setTime(i.getTime()-1),console.log(i),document.cookie="use="+escape("")+";expires="+i.toUTCString()+";path=/zhouyingwei-xiangmu2";$(".hl").html('<div class="meideng">\n                    <a href="html/Login.html">免费注册</a>\n                    <a href="html/Login.html">登录</a>\n                </div>'),$("#goushu").html("购物车(0)")})}}),$.ajax({type:"POST",url:"api/api.php",data:"jiekou=gouwuche&user="+w,success:function(i){var t=JSON.parse(i);$("#goushu").html("购物车("+t.length+")")}})),$(".temaipin img").hover(function(){$(this).stop().animate({bottom:"5px"},300)},function(){$(this).stop().animate({bottom:"0"},300)}),$(".shangpin").on("mouseover","li",function(){$(this).children().find("img").stop().animate({right:"10px"},200)}),$(".shangpin").on("mouseout","li",function(){$(this).children().find("img").stop().animate({right:"0px"},200)})});