!function(t){var e={};function a(r){if(e[r])return e[r].exports;var n=e[r]={i:r,l:!1,exports:{}};return t[r].call(n.exports,n,n.exports,a),n.l=!0,n.exports}a.m=t,a.c=e,a.d=function(t,e,r){a.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:r})},a.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},a.t=function(t,e){if(1&e&&(t=a(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var r=Object.create(null);if(a.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var n in t)a.d(r,n,function(e){return t[e]}.bind(null,n));return r},a.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return a.d(e,"a",e),e},a.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},a.p="/",a(a.s=36)}({36:function(t,e,a){t.exports=a(37)},37:function(t,e){$((function(){try{var t=new Date((new Date).getFullYear(),(new Date).getMonth(),(new Date).getDate());$("#datetimepicker").datetimepicker({format:"yyyy-mm-dd HH:MM",footer:!0,modal:!0,minDate:t,locale:"fr-fr",uiLibrary:"bootstrap4",change:function(t){$("#datetimepicker").val().length<19&&$("#datetimepicker").val($("#datetimepicker").val()+":00")}})}catch(t){console.error(t)}function e(t){var e=$(this).parents(".MemberCard").attr("data-name");0!=members.filter((function(t){return t.name==e})).length&&(members.splice(members.indexOf(e),1),confirm("Voulez vous supprimez de la liste ".concat(e,"?"))&&axios({method:"DELETE",url:"/admin/member/".concat(e)}).then((function(t){200==t.status&&$('.MemberCard[data-name="'.concat(e,'"')).remove()})))}function a(t){var a=$(t.target).parents(".MemberCard").find(".MemberCard-name").val(),r=$(t.target).parents(".MemberCard").find(".MemberCard-class").val();a=a.toLowerCase().split(" ");for(var n=0;n<a.length;n++)a[n]=a[n].charAt(0).toUpperCase()+a[n].slice(1);a=a.join(" "),members.filter((function(t){return t.name==a})).length>0||""!=a&&""!=r&&(members.push({name:a,classroom:r}),axios({method:"POST",url:"/admin/member",data:{name:a,classroom:r}}).then((function(n){$(t.target).parents(".MemberCard").find(".MemberCard-name").val(""),$(t.target).parents(".MemberCard").find(".MemberCard-class").val(""),200==n.status&&($("#AdminLayout-membersList").append('\n                    <div class="MemberCard col-12 col-md-6" data-name="'.concat(a,'">\n                        <div class="MemberCard-header">\n                            <h3 class="MemberCard-name">').concat(a," <small>").concat(r,'</small></h3>\n                        </div>\n                        <div class="MemberCard-actions">\n                            <button class="MemberCard-delete">Supprimer</button>\n                        </div>\n                    </div>\n                ')),$(".MemberCard-delete").on("click",e))})))}$(".blog-form #name").on("keyup",(function(){$(".blog-form #slug").val(window.removeDiacritics($(this).val()))})),$(".forum-form #name").on("keyup",(function(){$(".forum-form #slug").val(window.removeDiacritics($(this).val()))})),$(".InfoCard-delete").click((function(t){var e=$(this).parents(".InfoCard").attr("data-id");confirm("Voulez vous supprimez cette information?")&&axios({method:"DELETE",url:"/admin/info/".concat(e)}).then((function(t){return location.reload()}))})),$(".InfoCard-add").click((function(t){$("#modalEdit").attr("data-id","0"),$("#modalEdit").attr("data-method","POST"),$("#modalEdit .modal-title").text("Ajouter une information"),$("#modalEdit").find(".InfoCard-title").val(""),$("#modalEdit").find("textarea.InfoCard-content").val(""),$("#modalEdit").modal("show")})),$(".InfoCard-edit").click((function(t){$("#modalEdit").attr("data-id",$(this).parents(".InfoCard").attr("data-id")),$("#modalEdit").attr("data-method","PUT"),$("#modalEdit .modal-title").text("Editer l'information"),$("#modalEdit").find(".InfoCard-title").val($(this).parents(".InfoCard").find(".InfoCard-title").text()),$("#modalEdit").find("textarea.InfoCard-content").val($(this).parents(".InfoCard").find(".InfoCard-content").html().replace(/<p class="paraph">|<\/p>/g,"").replace(/<br>/g,"\n")),$("#modalEdit").modal("show")})),$("#editInfo").on("click",(function(t){var e=$("#modalEdit").attr("data-method"),a=$("#modalEdit").find(".InfoCard-title").val(),r='<p class="paraph">'+$("#modalEdit").find("textarea.InfoCard-content").val().replace(/(?:\r\n|\r|\n)/g,"<br>")+"</p>";axios({method:e,url:"/admin/info".concat("PUT"==e?"/".concat($("#modalEdit").attr("data-id")):""),data:{title:a,content:r}}).then((function(t){return location.reload()}))})),$(".UserCard-delete").click((function(t){var e=$(this).parents(".UserCard").attr("data-name"),a=$(this).parents(".UserCard").attr("data-uuid");confirm("Voulez vous supprimez l'utilisateur ".concat(e,"?"))&&axios({method:"DELETE",url:"/admin/user/".concat(a)}).then((function(t){return location.reload()}))})),$(".UserCard-changeLevel").change((function(t){var e=$(this).parents(".UserCard").attr("data-name"),a=$(this).parents(".UserCard").attr("data-uuid"),r=$(this).find("option:selected").val();confirm("Voulez vous mettre l'utilisateur ".concat(e," au rang ").concat(["d'utilisateur","de modérateur","d'administrateur"][r-1],"?"))&&axios({method:"PUT",url:"/admin/user/".concat(a),data:{level:r}}).then((function(t){return location.reload()}))})),$(".MemberCard-delete").click(e),$(".MemberCard-add").click(a),$("input.MemberCard-class").on("keyup",(function(t){13==t.which&&a(t)})),$("#blog").on("change",(function(){"false"!=$("#title").attr("data-changed")&&""!=$("#title").val()||($("#title").val($(this).find(":selected").html()),$("#title").attr("data-changed","false"))})),$("#title").keypress((function(){$(this).attr("data-changed","true")})),$("#maxplaces-toggle").click((function(){$(this).is(":checked")?($("#maxplaces").attr("data-before",$("#maxplaces").val()),$("#maxplaces").val("-1"),$("#maxplaces").prop("readonly",!0)):($("#maxplaces").val($("#maxplaces").attr("data-before")),$("#maxplaces").prop("readonly",!1))})),"-1"==$("#maxplaces").val()&&($("#maxplaces").prop("readonly",!0),$("#maxplaces-toggle").prop("checked",!0),$("#maxplaces").attr("data-before","10"))}))}});